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
            doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"/>
    <!--    Как получить имя пользователя и документ на котором он сейчас нахоится добавить новый элемент в документ?-->
    <xsl:include href="toc.xsl"/>
    <!--    <xsl:include href="../stylesheets/DocumentList/DocumentView.xsl"/>-->
    <!--    <xsl:variable name="newline">
        <xsl:text>
        </xsl:text>
    </xsl:variable>-->
    <xsl:strip-space elements="*"/>

    <!-- the identity template -->
    <xsl:template match="@*|node()">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="processing-instruction('xml-stylesheet')">
    </xsl:template>
    <xsl:template match="xhtml:head">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()"/>
            <link rel="stylesheet" type="text/css" href="oooxhtml/oooxhtml.css"/>
            <script type="text/javascript" src="/privapi/web/scripts/privilegedAPI.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <script type="text/javascript" src="oooxhtml/oooxhtml.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="xhtml:body">
        <xsl:copy>
            <div class="contents">
                <form action="AddSubscription.php" method="post">
                    <fieldset>
                        <legend>Подписать</legend>
                        <input type="text" name="name-0"/>
                        <input type="hidden" name="document-0">
                            <xsl:attribute name="value">
                                <xsl:value-of select="xhtml:file"/>
                            </xsl:attribute>
                        </input>
                        <label>
                            Группа
                            <input type="checkbox" name="group-0"/>
                        </label>
                        <br/>
                        <label>
                            Выберите тег
                            <select name="tag-0">
                                <option>---</option>
                                <xsl:for-each select="//xhtml:h2">
                                    <option>
                                        <xsl:value-of select="@id"/>
                                    </option>
                                </xsl:for-each>
                                <xsl:for-each select="//xhtml:h3">
                                    <option>
                                        <xsl:value-of select="@id"/>
                                    </option>
                                </xsl:for-each>
                                <xsl:for-each select="//xhtml:h4">
                                    <option>
                                        <xsl:value-of select="@id"/>
                                    </option>
                                </xsl:for-each>
                            </select>
                        </label>

                        <button>Подписать</button>
                    </fieldset>
                </form>
                <p>Содержание</p>
                <ol>
                    <xsl:apply-templates select="//xhtml:h1" mode="ToC"/>
                </ol>
            </div>
            <xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:template>

</xsl:stylesheet>
