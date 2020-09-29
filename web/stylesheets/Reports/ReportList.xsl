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
                <title>Список подписок</title>
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

            <form class="ui form">
                <div class="two field">
                    <div class="field">
                        <button class="ui button fluid" name="typeReport-0" value="subscriptions">
                            Отчет по подпискам
                        </button>
                    </div>
                    <div class="field">
                        <button class="ui button fluid" name="typeReport-0" value="offers">
                            Отчет по предложениям
                        </button>
                    </div>
                </div>
            </form>
            <xsl:choose>
                <!--      Отчет если по предложениям    -->
                <xsl:when test="type='offers'">
                    <table summary="" class="ui celled  table">

                        <thead>
                            <tr>
                                <th>Логин</th>
                                <th>Принято</th>
                                <th>Всего</th>
                            </tr>
                        </thead>

                        <tbody>
                            <xsl:for-each select="report/elements">
                                <tr>
                                    <td>
                                        <xsl:value-of select="login"/>
                                    </td>
                                    <td>
                                        <xsl:value-of select="accept"/>
                                    </td>
                                    <td>
                                        <xsl:value-of select="count"/>
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>

                    </table>
                </xsl:when>

                <!--      Отчет по подпискам      -->
                <xsl:when test="type='subscriptions'">
                    <table summary="" class="ui celled  table">

                        <thead>
                            <tr>
                                <th>Логин</th>
                                <th>Имя материала</th>
                                <th>Прочтено</th>
                            </tr>
                        </thead>

                        <tbody>
                            <xsl:for-each select="report/elements">
                                <tr>
                                    <td>
                                        <xsl:value-of select="login"/>
                                    </td>
                                    <td>
                                        <xsl:value-of select="name_material"/>
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
                </xsl:when>

                <xsl:otherwise>
                    <xsl:text><![CDATA[]]></xsl:text>
                </xsl:otherwise>

            </xsl:choose>

        </div>
    </xsl:template>

</xsl:stylesheet>
