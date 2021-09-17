#!/bin/bash
vpc_id=$(aws ec2 create-vpc --cidr-block 10.0.0.0/16 --query Vpc.VpcId --output text)
aws ec2 create-tags  --resources "$vpc_id" --tags Key=Name,Value=IPA-VPC
subnet1_id_pub=$(aws ec2 create-subnet --vpc-id "$vpc_id" --cidr-block 10.0.0.0/18 --availability-zone us-east-1a --query Subnet.SubnetId --output text)
subnet2_id_pub=$(aws ec2 create-subnet --vpc-id "$vpc_id" --cidr-block 10.0.64.0/18 --availability-zone us-east-1a --query Subnet.SubnetId --output text)
subnet3_id_priv=$(aws ec2 create-subnet --vpc-id "$vpc_id" --cidr-block 10.0.128.0/18 –availability-zone us-east-1b --query Subnet.SubnetId --output text)
subnet4_id_priv=$(aws ec2 create-subnet --vpc-id "$vpc_id" --cidr-block 10.0.192.0/18 --availability-zone us-east-1b --query Subnet.SubnetId --output text)
gateway_id=$(aws ec2 create-internet-gateway --query InternetGateway.InternetGatewayId --output text)
aws ec2 attach-internet-gateway --vpc-id "$vpc_id" --internet-gateway-id "$gateway_id"
aws ec2 create-route --route-table-id "$route_table_id1" --destination-cidr-block 0.0.0.0/0 --gateway-id "$gateway_id" 
aws ec2 associate-route-table  --subnet-id "$subnet1_id_pub" --route-table-id "$route_table_id1"
aws ec2 associate-route-table  --subnet-id "$subnet2_id_pub" --route-table-id "$route_table_id1"
aws ec2 associate-route-table  --subnet-id "$subnet3_id_priv" --route-table-id "$route_table_id2"
aws ec2 associate-route-table  --subnet-id "$subnet4_id_priv" --route-table-id "$route_table_id2"
elastic_ip=$(aws ec2 allocate-address --domain vpc --query '{AllocationId:AllocationId}' --output text)
natgateway_id=$(aws ec2 create-nat-gateway --subnet-id "$subnet3_id_pub" --allocation-id "$elastic_ip" --query 'NatGateway.{NatGatewayId:NatGatewayId}' --output text)
aws ec2 create-route --route-table-id "$route_table_id2" --destination-cidr-block 0.0.0.0/0 --gateway-id "$natgateway_id"
 
