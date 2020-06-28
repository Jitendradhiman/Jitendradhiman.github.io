#!/usr/bin/env python2
# -*- coding: utf-8 -*-
"""
Created on Tue May  5 10:57:41 2020

@author: ranu
"""
import os
gen = "female"
speaker = 'slt'
path0 = './mosRZAP/'+gen+'/'+speaker + '/'
pathdes0 = './paths/' 
expLst = [d for d in sorted(os.listdir(path0)) if (not d.startswith('.') and not d.startswith('._'))]
'''
if (expLst[0]=='.DS_Store'):
   expLst.remove('.DS_Store')
if (expLst[0]=='._.DS_Store'):
   expLst.remove('._.DS_Store')
'''   
for i in range(len(expLst)):
   path1 = os.path.join(path0,expLst[i])
   #print path1
   filelist = [f for f in sorted(os.listdir(path1)) if (not f.startswith('._') and not f.startswith('.') and f.endswith('.wav'))]
   #path2=os.path.join(path1,'paths/')
   filename = expLst[i]
   fid = open(os.path.join('./paths/',filename+'_'+speaker)+'.txt','w+')
   for j in range(len(filelist)):
       fid.write(path1+'/'+filelist[j]+"\n")
   fid.close()    
            
    