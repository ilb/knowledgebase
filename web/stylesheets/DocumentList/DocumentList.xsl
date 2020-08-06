<?xml version="1.0" encoding="UTF-8"?>
<!-- Шаблон формы -->
<xsl:stylesheet
        xmlns="http://www.w3.org/1999/xhtml"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        exclude-result-prefixes="xhtml xsl"
        version="1.0">

    <xsl:output
            media-type="application/xhtml+xml"
            method="xml"
            encoding="UTF-8"
            indent="yes"
            omit-xml-declaration="no"
            doctype-public="-//W3C//DTD XHTML 1.1//EN"
            doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" />

    <xsl:strip-space elements="*" />

    <xsl:include href="../main.xsl"/>

    <xsl:template match="/">
        <html xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <xsl:call-template name="head"/>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Список документов</title>
            </head>
            <body onload="">
                <xsl:apply-templates />
            </body>
        </html>
    </xsl:template>

    <xsl:template match="/response">
        <div class="ui container">
            <table summary="" class="ui celled  table">
                <caption>
                    Весь список ресурсов и документов
                </caption>
                <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Тип материала</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:for-each select="/response/elements/documents">
                        <tr>
                            <td><xsl:value-of select="nameDocument"/></td>
                            <td>document</td>
                        </tr>
                        <xsl:for-each select="resources/resource[name!='']">
                            <tr>
                                <td><xsl:value-of select="name"/></td>
                                <td>resources</td>
                            </tr>
                        </xsl:for-each>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>

    </xsl:template>

</xsl:stylesheet>