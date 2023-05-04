import json
import random
import string
import argparse

parser=argparse.ArgumentParser()
parser.add_argument("-U","--upload",type=string,help="Upload file to cloud, add file path")

filepath=".sendcmtool/files.json"

def getrds():
    # Define the length of the random string
    length = 10

    # Generate the random string
    random_string = ''.join(random.choices(string.ascii_letters + string.digits, k=length))
    print(random_string)

def getjs(path):
    with open(path,"r") as file:
        in1=file.read()
        out1=json.load(in1)
        return out1
    
def putjs(contents,path):
    with open(path,"w") as file:
        in1=json.dumps(contents)
        file.write(in1)
    return 1

def upload()

args=parser.parse_args()
if args.upload:


for key, value in person_dict.items():
    print(key, value)