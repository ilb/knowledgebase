# удаляем старые файлы классов
rm -rf ../generated
# генерируем новые файлы классов
happymeal-1 xsd2code \
-m ru\\ilb\\knowledgebase \
-o ../generated \
-s ../web/schemas \
command.xsd