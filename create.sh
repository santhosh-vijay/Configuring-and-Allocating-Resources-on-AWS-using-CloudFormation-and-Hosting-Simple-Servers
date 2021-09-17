#!/bin/bash

aws cloudformation create-stack --stack-name IPAstack --template-body file://config1.json
