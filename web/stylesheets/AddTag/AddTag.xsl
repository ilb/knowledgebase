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
                <title>Добавить тег</title>
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
        <div class="ui container" style="margin-bottom: 10px">
            <form action="" method="post" class="ui form">
                <h4 class="ui dividing header">Выберите документ и введите ключевое слово</h4>
                <div class="two fields">

                    <div class="field">
                        <select class="ui fluid dropdown" name="document">
                            <xsl:for-each select="/response/elements/documents">
                                <option>
                                    <xsl:attribute name="value">
                                        <xsl:value-of select="nameDocument"/>
                                    </xsl:attribute>
                                    <xsl:value-of select="nameDocument"/>
                                </option>
                            </xsl:for-each>
                        </select>
                    </div>
                    <div class="field">
                        <input type="text" name="keyWord" placeholder="Ключевое слово"/>
                    </div>

                </div>
                <button class="ui button">Добавить</button>
            </form>
        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>