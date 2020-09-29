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
                <div class="full">
                    <div class="toc">
                        <xsl:call-template name="menu-header"/>
                    </div>
                    <div class="article">
                        <xsl:apply-templates />
                    </div>
                </div>
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
                        <th>Имя материала</th>
                        <th>Принято</th>
                        <th>Изменения</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:for-each select="elements">
                        <tr>
                            <td>
                                <xsl:value-of select="name_material"/>
                            </td>
                            <td>
                                <xsl:choose>
                                    <xsl:when test="accepted = 0">
                                        нет
                                    </xsl:when>
                                    <xsl:otherwise>
                                        да
                                    </xsl:otherwise>
                                </xsl:choose>
                            </td>
                            <td>
                                <xsl:value-of select="diff"/>
                            </td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>
