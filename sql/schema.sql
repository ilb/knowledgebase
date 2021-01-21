drop schema if exists knowledgebase;
create schema knowledgebase;
grant all privileges on knowledgebase.* to 'knowledgebase'@'localhost' identified by 'knowledgebase';
grant all privileges on knowledgebase.* to 'knowledgebase'@'%' identified by 'knowledgebase';
