#!/bin/bash

M=1000000
K=1000

if (( $2<$M )); then
  digit_1M=0
else
  digit_1M=$(( $2/M*M ))	# always int
fi

#echo $digit_1M

if (( $2<$K )); then
  digit_1K=0
else
  digit_1K_rev=`echo $2 | rev`
  if (( ${digit_1K_rev:3:1}==0 )); then
    digit_1K=0
  elif (( ${digit_1K_rev:3:1}==1 )); then
    digit_1K=1000
  elif (( ${digit_1K_rev:3:1}==2 )); then
    digit_1K=2000
  elif (( ${digit_1K_rev:3:1}==3 )); then
    digit_1K=3000
  elif (( ${digit_1K_rev:3:1}==4 )); then
    digit_1K=4000
  elif (( ${digit_1K_rev:3:1}==5 )); then
    digit_1K=5000
  elif (( ${digit_1K_rev:3:1}==6 )); then
    digit_1K=6000
  elif (( ${digit_1K_rev:3:1}==7 )); then
    digit_1K=7000
  elif (( ${digit_1K_rev:3:1}==8 )); then
    digit_1K=8000
  elif (( ${digit_1K_rev:3:1}==9 )); then
    digit_1K=9000
  fi
fi

#echo $digit_1K

#echo $3/$1/$digit_1M/$digit_1K

awk -F"\t" '{if($1=="'$1'" && $2=="'$2'") print}' "$3/$1/$digit_1M/$digit_1K"

