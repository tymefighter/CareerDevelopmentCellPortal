#!/bin/sh

for sqlFile in "./sql_files"/* 
do
    mysql cdc <  "$sqlFile"
done
