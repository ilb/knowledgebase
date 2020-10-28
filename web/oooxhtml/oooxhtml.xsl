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
    <!--    <xsl:include href="../stylesheets/DocumentList/ViewDocument.xsl"/>-->
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
            <script type="text/javascript" src="js/subscribe.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <script type="text/javascript" src="js/createDocument.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <style>
                response {
                    display: none;
                }
                .subscribe {
                    font-weight: normal; color: #0d22b1; cursor: pointer;
                    font-size: 15px;
                }
                h2 .subscription, h3 .subscription, h4 .subscription, h1 .subscription {
                    font-size: 15px;
                }
                h2 span, h3 span, h4 span, h1 span {
                    display: none;
                }
                .fon {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    width: 100%;
                    background: #7b7b7b;
                    z-index: 9999999;
                }
                .window {
                    background: white;
                    padding: 3%;
                    width: 40%;
                    height: 20%;
                    position: relative;
                    left: 27%;
                    top: 27%;
                }
                .window > form * {
                    margin: 5px;
                }
                .window > span {
                    padding: 6px;
                    position: absolute;
                    top: 2px;
                    right: 2px;
                    cursor: pointer;
                    font-size: 1.5em;
                    background: #7b7b7b;
                    border-radius: 10%;
                    opacity: .5;
                }
                dirs {
                    display: none;
                }
            </style>
        </xsl:copy>
    </xsl:template>

    <xsl:template match="xhtml:body">
        <xsl:copy>
            <div class="contents">
                <a href="DocumentList.php">
                    На главную
                </a>
                <p>Содержание</p>
                <ol>
                    <xsl:apply-templates select="//xhtml:h1" mode="ToC"/>
                </ol>
            </div>
            <xsl:apply-templates select="@*|node()"/>
            <div class="fon" style="display: none;">
                <div class="window">
                    <form class="ui form create_document">
                        <div class="two fields">
                            <div class="field">
                                <label>
                                    Directory:
                                    <select class="ui fluid dropdown">
                                        <option>
                                            ---
                                        </option>
                                        <xsl:for-each select="xhtml:dirs/xhtml:item">
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
                    <span>
                        X
                    </span>
                </div>
            </div>
        </xsl:copy>
    </xsl:template>

</xsl:stylesheet>
