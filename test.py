import requests, json, urllib3

def lambda_handler(event, context):
	urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

	token_url = "https://mmedia:7890/oauth/token"

	test_api_url = "https://mmedia:7890/api/phone-logs"

	#client (application) credentials on apim.byu.edu
	client_id = '1'
	client_secret = 'nBQccv2NCpoHAy6gtdq9BChkfBcFoDNrNHkY6jUL'

	#step A, B - single call with client credentials as the basic auth header - will return access_token
	data = {'grant_type': 'client_credentials'}

	access_token_response = requests.post(token_url, data=data, verify=False, allow_redirects=False, auth=(client_id, client_secret))

	#print (access_token_response.headers)
	#print (access_token_response.text)

	tokens = json.loads(access_token_response.text)

	#print ("access token: " + tokens['access_token'])

	#step B - with the returned access_token we can make as many calls as we want

	api_call_headers = {'Authorization': 'Bearer ' + tokens['access_token']}
	api_call_response = requests.get(test_api_url, headers=api_call_headers, verify=False)

	data = {'number':'+48740602005',
	        'type':'INBOUND'}

	# sending post request and saving response as response object
	r = requests.post(url = test_api_url, data = data, headers=api_call_headers, verify=False)

	print (r)

	return {
        'statusCode': 200,
        'body': r
    }