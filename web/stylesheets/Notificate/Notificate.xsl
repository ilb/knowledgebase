<?xml version="1.0" encoding="UTF-8"?>
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
                <title>Уведомление</title>
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
        <div class="ui fluid container" >
            <table summary="" class="ui celled table">
                <caption>
                    Весь список ресурсов и документов
                </caption>
                <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Изменения</th>
                        <th>Ознакомлен</th>
                    </tr>
                </thead>
                <tbody>
                    <!--                    <xsl:if test="/response/elements/documents">-->
                    <xsl:for-each select="/response/result">
                        <tr>
                            <td>
                                <a>
                                    <xsl:attribute name="href">
                                        <xsl:value-of select="concat('DocumentView.php/', name_material)"/>
                                    </xsl:attribute>
                                </a>
                                <xsl:value-of select="name_material"/>
                            </td>
                            <td style="word-break: break-all;">
                                <xsl:value-of select="diff"/>
                            </td>
                            <td>
                                <xsl:choose>
                                    <xsl:when test="is_read = 0">
                                        нет
                                    </xsl:when>
                                    <xsl:otherwise>
                                        да
                                    </xsl:otherwise>
                                </xsl:choose>
                            </td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>
