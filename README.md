## SSH attempted connections map

Simple web app for mapping attempted ssh connections to a server.

[Demo here](http://sshmap.algroy.me).

### Installation

1. Clone repo to webserver root
1. Add your ipinfodb.com api key to `get_locations.py`, and set paths for `ips.txt` and `locations.json`
1. Copy `read_auth.sh` to your preferred directory where it will be run by root
1. Add crontabs for `read_auth.sh` and `get_locations.py`. For example:
    - `* * * * * /root/read_auth.sh > /var/www/html/ips.txt`
    - `*/5 * * * * /usr/bin/python3 /var/www/html/get_locations.py > /dev/null`

**TODO**

- Prevent multiple API lookups of the same IP
- Add more extensive UI
- Add whitelist for IP ranges or locations
- Improve UI on mobile

