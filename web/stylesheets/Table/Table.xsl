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
            doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"/>

    <xsl:strip-space elements="*"/>

    <xsl:template match="/">
        <html xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>Docs</title>
                <script type="text/javascript" src="js/createDocument.js">
                    <xsl:text><![CDATA[]]></xsl:text>
                </script>
            </head>
            <body onload="">
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="/response">
        <form class="ui form create_document">
            <fieldset>
                <legend>Добавить документ</legend>
                <div class="two fields">
                    <div class="field">
                        <label>
                            <select class="ui fluid dropdown" style="display: none">
                                <option>
                                    <xsl:choose>
                                        <xsl:when test="/response/item/parent != ''">
                                            <xsl:value-of
                                                    select="substring(/response/item/parent, 0, string-length(/response/item/parent))"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            ---
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </option>
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
            </fieldset>
        </form>
        <table class="ui celled selectable table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <th>
                        <xsl:text><![CDATA[]]></xsl:text>
                    </th>
                    <th>
                        <xsl:text><![CDATA[]]></xsl:text>
                    </th>
                    <th>Descr</th>
                </tr>
                <tr>
                    <td>
                        <a>

                            <xsl:attribute name="href">
                                <xsl:value-of select="concat('index.php?dir-0=', parentDir)"/>
                            </xsl:attribute>

                            Parent Directory
                        </a>
                    </td>

                    <td>
                        <xsl:text><![CDATA[]]></xsl:text>
                    </td>
                    <td>
                        <xsl:text><![CDATA[]]></xsl:text>
                    </td>
                    <td>
                        <xsl:text><![CDATA[]]></xsl:text>
                    </td>
                </tr>
                <xsl:for-each select="/response/item">
                    <tr>
                        <td>
                            <a>
                                <xsl:choose>
                                    <xsl:when test="dir = 0">
                                        <xsl:attribute name="href">
                                            <xsl:value-of select="concat('DocumentView.php?url-0=',parent,'/', name)"/>
                                        </xsl:attribute>
                                    </xsl:when>
                                    <xsl:otherwise>
                                        <xsl:attribute name="href">
                                            <xsl:value-of
                                                    select="concat('index.php?dir-0=',parent, substring(name, 0, string-length(name)))"/>
                                        </xsl:attribute>
                                    </xsl:otherwise>
                                </xsl:choose>

                                <xsl:value-of select="name"/>
                            </a>
                        </td>

                        <td>
                            <xsl:text><![CDATA[]]></xsl:text>
                        </td>
                        <td>
                            <xsl:text><![CDATA[]]></xsl:text>
                        </td>
                        <td>
                            <xsl:value-of select="title"/>
                        </td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </xsl:template>

</xsl:stylesheet>