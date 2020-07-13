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

    <!-- https://github.com/fletcher/MMD-Support/blob/master/XSLT/xhtml-toc-h2.xslt -->
    <xsl:variable name="newline">
        <xsl:text>
        </xsl:text>
    </xsl:variable>
    <xsl:strip-space elements="*" />



    <!-- create ToC entry -->
    <xsl:template match="xhtml:h1" mode="ToC">
        <xsl:value-of select="$newline"/>
        <xsl:variable name="link">
            <xsl:value-of select="@id"/>
        </xsl:variable>
        <xsl:variable name="myId">
            <xsl:value-of select="generate-id(.)"/>
        </xsl:variable>
        <li>
            <a id="ToC-{$link}" href="#{$link}">
                <xsl:apply-templates select="node()"/>
            </a>
            <xsl:if test="following::xhtml:h2[1][preceding::xhtml:h1[1]]">
                <xsl:value-of select="$newline"/>
                <ol>
                    <xsl:apply-templates select="following::xhtml:h2[preceding::xhtml:h1[1][generate-id() = $myId]]" mode="ToC"/>
                    <xsl:value-of select="$newline"/>
                </ol>
                <xsl:value-of select="$newline"/>
            </xsl:if>
        </li>
    </xsl:template>
    <xsl:template match="xhtml:h2" mode="ToC">
        <xsl:value-of select="$newline"/>
        <xsl:variable name="link">
            <xsl:value-of select="@id"/>
        </xsl:variable>
        <xsl:variable name="myId">
            <xsl:value-of select="generate-id(.)"/>
        </xsl:variable>
        <li>
            <a id="ToC-{$link}" href="#{$link}">
                <xsl:apply-templates select="node()"/>
            </a>
            <xsl:if test="following::xhtml:h3[1][preceding::xhtml:h2[1]]">
                <xsl:value-of select="$newline"/>
                <ol>
                    <xsl:apply-templates select="following::xhtml:h3[preceding::xhtml:h2[1][generate-id() = $myId]]" mode="ToC"/>
                    <xsl:value-of select="$newline"/>
                </ol>
                <xsl:value-of select="$newline"/>
            </xsl:if>
        </li>
    </xsl:template>

    <xsl:template match="xhtml:h3" mode="ToC">
        <xsl:value-of select="$newline"/>
        <xsl:variable name="link">
            <xsl:value-of select="@id"/>
        </xsl:variable>
        <li>
            <a id="ToC-{$link}" href="#{$link}">
                <xsl:apply-templates select="node()"/>
            </a>
        </li>
    </xsl:template>

    <!-- h1 and xhtml:h2's should point back to the ToC for easy navigation -->
    <xsl:template match="xhtml:h2">
        <xsl:variable name="link">
            <xsl:value-of select="@id"/>
        </xsl:variable>
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
            &#160;
            <a href="#ToC-{$link}">&#8617;</a>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="xhtml:h3">
        <xsl:variable name="link">
            <xsl:value-of select="@id"/>
        </xsl:variable>
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
            &#160;
            <a href="#ToC-{$link}">&#8617;</a>
        </xsl:copy>
    </xsl:template>
    <xsl:template match="xhtml:h4">
        <xsl:variable name="link">
            <xsl:value-of select="@id"/>
        </xsl:variable>
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
           &#160;
            <a href="#{$link}">&#x2606;</a>
        </xsl:copy>
    </xsl:template>

</xsl:stylesheet>
