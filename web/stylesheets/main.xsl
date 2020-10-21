<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    exclude-result-prefixes="xhtml xsl"
    version="1.0">

    <xsl:variable name="srcIframe">
        <xsl:text>/knowledgebase/content</xsl:text>
    </xsl:variable>

    <xsl:template name="head">
            <xsl:apply-templates select="xhtml:head"/>
            <link rel="stylesheet" type="text/css" href="/oooxhtml/oooxhtml.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <link rel="stylesheet" type="text/css" href="css/main.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <link rel="stylesheet" type="text/css" href="css/semantic.min.css">
                <xsl:text><![CDATA[]]></xsl:text>
            </link>
            <script type="text/javascript" src="js/jquery.min.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <script type="text/javascript" src="js/semantic.min.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
            <script type="text/javascript" src="/privapi/web/scripts/privilegedAPI.js">
                <xsl:text><![CDATA[]]></xsl:text>
            </script>
    </xsl:template>

    <xsl:template name="menu-header">
        <div class="ui large vertical menu">
            <div class="item">
                <form class="ui form" action="DocumentFind.php">
                    <div class="fields">
                        <div class="fluid field">
                            <input type="text"  name="keyWord" />
                        </div>
                        <div class="field">
                            <button class="ui button">
                                Поиск
                            </button>
                        </div>
                    </div>

                    <!--                    <button style="display: none"/>-->
                </form>
            </div>
            <a class="item" href="CreateDocument.php">
                Добавить документ
            </a>
            <a class="item" href="DocumentList.php">
                Список документов
            </a>
            <a class="item" href="AddTag.php">
                Добавить тег
            </a>
            <a class="item" href="ChangeDocument.php">
                Изменение документа
            </a>
            <a class="item" href="AddSubscription.php">
                Добавить подписку
            </a>
            <a class="item" href="SubscriptionsList.php">
                Список подписок
            </a>
            <a class="item" href="OffersList.php">
                Предложенные изменения
            </a>
            <a class="item" href="ReportList.php">
                Отчеты
            </a>
            <a class="item" href="ChangeUser.php">
                Управление пользователями
            </a>
            <a class="item" href="SendOffer.php">
                Предложить изменения
            </a>
            <a class="item" href="MyOffers.php">
                Мои корректировки
            </a>
            <a class="item" href="Notificate.php">
                Уведомления
            </a>
        </div>
    </xsl:template>
</xsl:stylesheet>
