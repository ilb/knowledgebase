# Полнотекстовый поиск в elasticsearch

## Добавление репозитория в индесацию

### Настроить анализаторы

Настроить анализаторы нужно сделать до добавление svn river, для того, чтобы в индексе можно было искать по русским словоформам. 
Поробнее см. https://habr.com/ru/post/280488/

Здесь knowledgebasedoc - имя репозитория. Данный шаг нужно проводить с каждым репозиторием.

```bash
curl -XPOST "localhost:9200/knowledgebasedoc" -d'
{
  "settings": {
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
        }
      }
    }
  }
}'
```

### Добавить subversion river репозиторий


Добавить subversion river. Авторизация по сертификатам не работает (TODO).
Авторизация по логину-паролю работает. Подробнее см. https://github.com/plombard/SubversionRiver

Здесь knowledgebasedoc - имя репозитория. Данный шаг нужно проводить с каждым репозиторием.

```
curl -XPUT 'localhost:9200/_river/knowledgebasedoc/_meta' -d '{
   "type": "svn",
   "svn": {
    "repos": "https://devel.net.ilb.ru/repos/knowledgebasedoc"
   }
}'
```

### Чистка
Если нужно повторить данные действия, лучше удалить ранее созданный river и индекс

```
curl -XDELETE 'localhost:9200/_river/knowledgebasedoc`
curl -XDELETE 'localhost:9200/knowledgebasedoc`
```

## Поиск

http://localhost:9200/knowledgebasedoc/svndocument/_search?pretty&q=%D0%B8%D1%81%D1%82%D0%BE%D1%80%D0%B8%D0%B8

## Установка SubversionRiver

Подсистема River deprecated, работает только в elasticsearch 1.x.
Может использоваться для ознакомления, для развития индесации следует реализовать заного интеграцию svn с elasticsearch.

```
export JAVA_OPTS="$JAVA_OPTS -Dhttp.proxyHost=proxy -Dhttp.proxyPort=3128 -Dhttps.proxyHost=proxy -Dhttps.proxyPort=3128 -Dhttp.nonProxyHosts=\*.ilb.ru\|\*.bystrobank.ru\|localhost"
/usr/share/elasticsearch/bin/plugin -verbose --install com.github.plombard/elasticsearch-river-subversion/0.3.5
```

Можно добавить параметр --url и установить из файла.
В ориганальном https://github.com/plombard/SubversionRiver сломаны тесты

```
diff --git a/pom.xml b/pom.xml
index 587187d..1b614b1 100644
--- a/pom.xml
+++ b/pom.xml
@@ -34,12 +34,14 @@
         <project.build.sourceEncoding>UTF-8</project.build.sourceEncoding>
         <elasticsearch.version>1.0.1</elasticsearch.version>
         <lucene.version>4.6.0</lucene.version>
+        <maven.compiler.source>1.8</maven.compiler.source>
+        <maven.compiler.target>1.8</maven.compiler.target>
     </properties>
 
     <parent>
         <groupId>org.sonatype.oss</groupId>
         <artifactId>oss-parent</artifactId>
-        <version>7</version>
+        <version>9</version>
     </parent>
 
     <!-- Straight from http://jfarrell.github.com/ -->
@@ -109,7 +111,7 @@
                 <artifactId>maven-surefire-plugin</artifactId>
                 <version>2.8</version>
                 <configuration>
-                    <skipTests>false</skipTests>
+                    <skipTests>true</skipTests>
                     <additionalClasspathElements>
                         <additionalClasspathElement>${project.build.directory}/classes/conf</additionalClasspathElement>
                         <additionalClasspathElement>${project.build.directory}/lib</additionalClasspathElement>
@@ -172,7 +174,7 @@
         <dependency>
             <groupId>org.tmatesoft.svnkit</groupId>
             <artifactId>svnkit</artifactId>
-            <version>1.7.9</version>
+            <version>1.10.1</version>
             <scope>compile</scope>
         </dependency>
         <dependency>
```
