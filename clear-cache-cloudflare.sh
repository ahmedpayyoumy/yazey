#!/bin/bash

# Purge cache cloudflare script
ZONE_ID=$1
TOKEN=$2

printf "\n\033[93mCalling purge api from cloudflare...\033[0m\n"

echo ""

if curl -s -X POST "https://api.cloudflare.com/client/v4/zones/$ZONE_ID/purge_cache" \
     -H "Authorization: Bearer $TOKEN" \
     -H "Content-Type:application/json" \
     --data '{"purge_everything":true}' | grep -q true
then
  printf "\n \033[32mSuccessfully purged assets. \033[0mPlease allow up to 30 seconds for changes to take effect. \n"
else
  printf "\n\033[31mFail to purged assets. \033[0mPlease read the error code, check your Zone ID, Your Token and try again.\n\n"

curl -s -X POST "https://api.cloudflare.com/client/v4/zones/$ZONE_ID/purge_cache" \
     -H "Authorization: Bearer $TOKEN" \
     -H "Content-Type:application/json" \
     --data '{"purge_everything":true}' | python -m json.tool
fi
