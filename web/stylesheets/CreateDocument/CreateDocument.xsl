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
                <script type="text/javascript" src="js/createDocument.js">
                    <xsl:text><![CDATA[]]></xsl:text>
                </script>
                <title>Добавить документ</title>
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
            <form class="ui form create_document">
                <div class="two fields">
                    <div class="field">
                        <label>
                            Directory:
                            <select class="ui fluid dropdown">
                                <option>
                                    ---
                                </option>
                                <xsl:for-each select="/response/item">
                                    <option>
                                        <xsl:value-of select="."/>
                                    </option>
                                </xsl:for-each>
                            </select>
                        </label>
                    </div>

                    <div class="field">
                        <label>
                            Имя документа
                            <input type="text" placeholder="Имя документа"/>
                        </label>

                    </div>
                </div>
                <div class="field">
                    <button>
                        Добавить
                    </button>
                </div>
            </form>

        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>