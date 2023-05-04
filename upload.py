import argparse

parser=argparse.ArgumentParser()
parser.add_argument("-o","--Output",help="Show Output")
parser.add_argument("-i","--Input",help="Show Input")

args=parser.parse_args()

if args.Output:
    print("Displaying outputs as : %s"%args.Output)