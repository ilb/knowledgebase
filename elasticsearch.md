# Полнотекстовый поиск в elasticsearch

## Установка elasticsearch
Установить и запустить elasticsearch.

Можно [скать архив](https://www.elastic.co/downloads/elasticsearch) и запустить вручную командой `bin/elasticsearch`

Проверить работу elasticsearch можно с помощью curl `curl localhost:9200`

## Установка fscrawler
Установить fscrawler.
Можно [скачать архив](https://fscrawler.readthedocs.io/en/latest/installation.html).

Настроить умолчания для индексов в файле .fscrawler/_default/7/_settings.json
Поробнее см. https://habr.com/ru/post/280488/
В блок settings добавить блок analysis:

```json
{                                                                                                                                                                                              
  "settings": {                                                                                                                                                                                
    "number_of_shards": 1,                                                                                                                                                                     
    "index.mapping.total_fields.limit": 2000,                                                                                                                                                  
    "analysis": {                                                                                                                                                                              
      "filter": {                                                                                                                                                                              
        "ru_stop": {                                                                                                                                                                           
          "type": "stop",                                                                                                                                                                      
          "stopwords": "_russian_"                                                                                                                                                             
        },                                                                                                                                                                                     
        "ru_stemmer": {                                                                                                                                                                        
          "type": "stemmer",                                                                                                                                                                   
          "language": "russian"                                                                                                                                                                
        }                                                                                                                                                                                      
      },                                                                                                                                                                                       
      "analyzer": {                                                                                                                                                                            
        "default": {                                                                                                                                                                           
          "char_filter": [                                                                                                                                                                     
            "html_strip"                                                                                                                                                                       
          ],                                                                                                                                                                                   
          "tokenizer": "standard",                                                                                                                                                             
          "filter": [                                                                                                                                                                          
            "lowercase",                                                                                                                                                                       
            "ru_stop",                                                                                                                                                                         
            "ru_stemmer"                                                                                                                                                                       
          ]                                                                                                                                                                                    
        },                                                                                                                                                                                     
        "fscrawler_path": {                                                                                                                                                                    
          "tokenizer": "fscrawler_path"                                                                                                                                                        
        }                                                                                                                                                                                      
      },                                                                                                                                                                                       
      "tokenizer": {                                                                                                                                                                           
        "fscrawler_path": {                                                                                                                                                                    
          "type": "path_hierarchy"                                                                                                                                                             
        }                                                                                                                                                                                      
      }                                                                                                                                                                                        
    }                                                                                                                                                                                          
  }
  ...
}
```

## Запуск fscrawler

1. Запустить `bin/fscrawler` knowledgebase
2. Настроить в $HOME/.fscrawler/knowledgebase/_settings.yaml `url`, `update_rate`, `excludes`
```
fs:                                                                                                                                                                                            
  url: "/var/apps/knowledgebase"                                                                                                                                                               
  update_rate: "5m"                                                                                                                                                                            
  excludes:                                                                                                                                                                                    
  - "*/~*"                                                                                                                                                                                     
  - "*/.svn"
```
3. Запустить `bin/fscrawler` knowledgebase
Программа будет работат в фоне и сканировать каталог.
Для проверки выполнить команду `curl 'http://localhost:9200/_search?q=test&pretty'`
Так же можно настроить однократный цикл, например для работы через cron, указав параметр `--loop 1`
Для повторной реиндексации каталога использовать параметр `--restart`

## FAQ

### Ошибка low disk watermark [??%] exceeded on
Ошибка возникает, если на диске мало места см. https://stackoverflow.com/questions/33369955/low-disk-watermark-exceeded-on
Настроить порог ошибки в `elasticsearch.yml`

```
cluster.routing.allocation.disk.threshold_enabled: true                                                                                                                                        
cluster.routing.allocation.disk.watermark.low: 93%                                                                                                                                             
cluster.routing.allocation.disk.watermark.high: 95% 
```
