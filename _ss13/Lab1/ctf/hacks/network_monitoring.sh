#ssh root@192.168.40.117 tcpdump -U -s0 -w - 'no port 22' | gksu wireshark -k -i -
ssh root@192.168.40.117 tcpdump -U -s0 -w -n not dst port 22 and not src port 22 | wireshark.sh 

