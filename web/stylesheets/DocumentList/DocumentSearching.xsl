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
                <title>Поиск</title>
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
            <xsl:if test="/response/docs/doc = ''">
                <p>Ничего не найденно</p>
            </xsl:if>
            <xsl:for-each select="/response/docs/doc">
                <div class="ui raised segment">
                    <a class="ui red ribbon label">
                        <xsl:attribute name="href">
                            <xsl:value-of select="concat('DocumentView.php?url-0=', path)"/>
                        </xsl:attribute>
                        <xsl:value-of select="name"/>
                    </a>
                    <p>
                        <xsl:value-of select="content" disable-output-escaping="yes"/>
                    </p>
                </div>
            </xsl:for-each>
        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>
