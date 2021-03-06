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
                <title>Изменить пользователя</title>
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
            <form action="" method="post" class="ui form">
            <table class="ui celled selectable table">
                <caption>
                    Пользователи
                </caption>
                <thead>
                    <tr>
                        <th>Пользователь</th>
                        <th>Статус</th>
                        <th>Применить</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:for-each select="/response/users/user">
                        <tr>
                            <td>
                                <xsl:value-of select="login"/>
                            </td>

                            <td>
				
				<xsl:if test="status = 'admin'">
				    <span>
					Администратор
				    </span>
				</xsl:if>
				    
				<xsl:if test="status != 'admin'">
				    <select class="ui fluid dropdown">

					<xsl:attribute name="name">
					    <xsl:value-of select="concat('status_', id_user)"/>
					</xsl:attribute>

					<option>
					    <xsl:if test="status = 'user'">
						<xsl:attribute name="selected">selected</xsl:attribute>
					    </xsl:if>
					    user
					</option>

					<option>
					    <xsl:if test="status = 'mentor'">
						<xsl:attribute name="selected">selected</xsl:attribute>
					    </xsl:if>
					    mentor
					</option>
				    </select>
				</xsl:if>
                            </td>

                            <td>
				<xsl:if test="status != 'admin'">
				    <button class="ui fluid button" name="changeBtn">
					<xsl:attribute name="value">
					    <xsl:value-of select="id_user"/>
					</xsl:attribute>
					Изменить
				    </button>
				</xsl:if>
                            </td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
            </form>
        </div>
        <hr/>
    </xsl:template>

</xsl:stylesheet>