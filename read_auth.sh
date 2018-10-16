sudo grep "disconnect" /var/log/auth.log |
grep -v "sudo" |
awk '{ print system("echo -n `date -d \""$1" "$2" "$3"\" +%s`") " " ($9=="from" ? $10 : $9) }' |
sed -e 's/^0 //g' -e 's/0 / /g' -e 's/://g'
