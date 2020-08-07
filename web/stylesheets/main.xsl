<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    exclude-result-prefixes="xhtml xsl"
    version="1.0">

    <xsl:variable name="domen">
        <xsl:text>http://knowledgebaselib/knowledgebase/web/</xsl:text>
    </xsl:variable>

    <xsl:template name="head">
            <xsl:apply-templates select="xhtml:head"/>
            <link rel="stylesheet" type="text/css" href="/oooxhtml/oooxhtml.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <link rel="stylesheet" type="text/css" href="css/main.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <script type="text/javascript" src="/privapi/web/scripts/privilegedAPI.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <link rel="stylesheet" type="text/css" href="css/semantic.min.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <script type="text/javascript" src="js/jquery.min.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <script type="text/javascript" src="js/semantic.min.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
    </xsl:template>

    <xsl:template name="menu-header">
        <div class="ui menu">
            <a class="item" href="DocumentList.php">
                Список документов
            </a>
            <a class="item" href="AddTag.php">
                Добавить тег
            </a>
            <a class="item" href="SubscriptionsList.php">
                Список подписок
            </a>
            <a class="item" href="#">
                Предложить изменения
            </a>
            <a class="item" href="#">
                Отчет о подписках
            </a>
            <a class="item" href="ChangeUser.php">
                Поменять пользователя
            </a>
            <div class="right item">
                <form class="ui form" action="DocumentFind.php">
                    <div class="ui icon input">
                        <input type="text"  name="keyWord" />
                        <!-- Добавить JS чтобы при нажатии отправляласб форма-->
<!--                        <i class="search link icon"/>-->
                    </div>
<!--                    <button style="display: none"/>-->
                </form>
            </div>
        </div>
    </xsl:template>
</xsl:stylesheet>
