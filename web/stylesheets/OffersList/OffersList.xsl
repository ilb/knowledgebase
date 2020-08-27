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
                <title>Список предложенных документов</title>
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
                <caption>Предложенные корректировки</caption>
                <thead>
                    <tr>
                        <th>Пользователь</th>
                        <th>Материал</th>
                        <th>Изменения</th>
                        <th>Принять</th>
                        <th>Отклонить</th>
                    </tr>
                </thead>

                <tbody>
                    <xsl:for-each select="/response/offer">
                        <tr>
                            <td>
                                <xsl:value-of select="login"/>
                            </td>

                            <td>
                                <xsl:value-of select="name_material"/>
                            </td>

                            <td>
                                <xsl:value-of select="diff"/>
                            </td>

                            <td>
                                <button class="ui fluid button">Принять</button>
                            </td>

                            <td>
                                <button class="ui fluid button">
                                    Отклонить
                                </button>
                            </td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>
