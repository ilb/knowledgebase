<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    exclude-result-prefixes="xhtml xsl"
    version="1.0">

    <xsl:variable name="date" select="'16.07.2001'"/>

    <xsl:template name="head">
        <xsl:copy>
            <xsl:apply-templates select="xhtml:head"/>
            <link rel="stylesheet" type="text/css" href="/knowledgebase/web/oooxhtml/oooxhtml.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <link rel="stylesheet" type="text/css" href="/knowledgebase/web/css/main.css">
                <xsl:text><![CDATA[]]></xsl:text>

            </link>
            <script type="text/javascript" src="/privapi/web/scripts/privilegedAPI.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <link rel="stylesheet" type="text/css" href="/knowledgebase/web/css/semantic.min.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <script type="text/javascript" src="/knowledgebase/web/js/jquery.min.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <script type="text/javascript" src="/knowledgebase/web/js/semantic.min.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
        </xsl:copy>
    </xsl:template>
</xsl:stylesheet>
