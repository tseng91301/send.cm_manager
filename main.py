import json
import random
import string

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

json_str = '{"name": "John", "age": 30, "gender": {}}'

person_dict = json.loads(json_str)

person_dict["occupation"] = "Software Engineer"
person_dict["age"] = 31
for key, value in person_dict.items():
    print(key, value)