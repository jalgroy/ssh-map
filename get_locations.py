#!/usr/bin/env python3
import json
import time
import requests
import calendar
import time
import copy

# Edit these three variables
API_KEY = ''
input_file = '/path/to/ips.txt'
output_file = '/path/to/locations.json' # Should be in the same directory as index.php

TIME_LIMIT = 14*24*60*60
current_time = calendar.timegm(time.gmtime())

class IPInfoDB:
    def __init__(self, api_key):
        self.api_key = api_key
    
    def get_coordinates(self, ip):
        r = requests.get('https://api.ipinfodb.com/v3/ip-city/?key=' + self.api_key + '&ip=' + ip)
        r.raise_for_status()
        info_list = r.content.decode("utf-8").split(";")
        return info_list[4:5] + info_list[6:7] + info_list[8:10]

# Check if entry already exists
def has_entry(loc_list, timing, ip):
    for entry in loc_list:
        if entry["time"] == int(timing) and entry["ip"] == ip:
            return True
    return False

# Remove entries older than TIME_LIMIT
def purge_old(loc_list):
    list_copy = copy.deepcopy(loc_list)
    for entry in list_copy:
        if current_time - entry["time"] > TIME_LIMIT:
            loc_list.remove(entry)
    return loc_list


ip_info = IPInfoDB(API_KEY)

loc_list = []

try:
    with open(output_file, 'r') as loc:
        if loc.read != "":
            loc_list = json.loads(loc.read())
except Exception:
    pass

loc_list = purge_old(loc_list)

# Do lookup of all new entries in intput file
with open(input_file,'r') as f:
    for line in f.readlines():
        timing = line.split()[0]
        ip = line.split()[1]
        if int(current_time) - int(timing) <= TIME_LIMIT and (not has_entry(loc_list, timing, ip)):
            print("Looking up " + ip)
            coor = ip_info.get_coordinates(ip)
            entry = {"time" : int(timing), "ip" : ip, "country" : coor[0], "city" : coor[1], "lat" : float(coor[2]), "lon" : float(coor[3])}
            loc_list.append(entry)
            time.sleep(0.55)
        else:
            print(ip + " already in file")

print("Writing to " + output_file)
with open(output_file, 'w') as out:
    json.dump(loc_list, out, sort_keys=True)
