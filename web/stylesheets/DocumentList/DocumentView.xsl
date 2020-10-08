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

    <xsl:template match="xhtml:h2">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
            as
        </xsl:copy>
    </xsl:template>

</xsl:stylesheet>
