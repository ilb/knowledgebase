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
                <title>Список документов</title>
            </head>
            <body onload="">
                <xsl:call-template name="menu-header"/>
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
<!--                    <xsl:if test="/response/elements/documents">-->
                    <xsl:for-each select="/response/elements/documents">
<!--                        Переменная для ссылки на ресурс-->
                        <xsl:variable name="src" select="source"/>
                        <xsl:variable name="docName" select="nameDocument"/>
                        <tr>
                            <td>
                                <a>
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="concat('DocumentView.php?url-0=', nameDocument)"/>
                                    </xsl:attribute>

                                    <xsl:value-of select="nameDocument"/>
                                </a>
                            </td>
                            <td>document</td>
                        </tr>
                        <xsl:for-each select="resources/resource[name!='']">
                            <tr>
                                <td>
                                    <a>
                                        <xsl:attribute name="href">
                                            <xsl:value-of select="concat('DocumentView.php?url-0=',$docName, '#', tag)"/>
                                        </xsl:attribute>

                                        <xsl:value-of select="name"/>
                                    </a>
                                </td>
                                <td>resource</td>
                            </tr>
                        </xsl:for-each>
                    </xsl:for-each>
<!--                    </xsl:if>-->
                    <xsl:for-each select="/response/elements/resource">
                        <tr>
                            <td>
                                <a>
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="concat('DocumentView.php?url-0=', name)"/>
                                    </xsl:attribute>

                                    <xsl:value-of select="name"/>
                                </a>
                            </td>
                            <td>resource</td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>
    <hr/>
    </xsl:template>

</xsl:stylesheet>
