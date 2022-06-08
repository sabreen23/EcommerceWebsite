<?php

use MailPoetVendor\Twig\Environment;
use MailPoetVendor\Twig\Error\LoaderError;
use MailPoetVendor\Twig\Error\RuntimeError;
use MailPoetVendor\Twig\Extension\SandboxExtension;
use MailPoetVendor\Twig\Markup;
use MailPoetVendor\Twig\Sandbox\SecurityError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedTagError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedFilterError;
use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedFunctionError;
use MailPoetVendor\Twig\Source;
use MailPoetVendor\Twig\Template;

/* emails/statsNotification.html */
class __TwigTemplate_dbcf4d8137e282a6bfc390950d1e7647f0e00197be42dc9c4a49adb26b5593b1 extends \MailPoetVendor\Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "emails/statsNotificationLayout.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("emails/statsNotificationLayout.html", "emails/statsNotification.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "  <tr>
  <td class=\"mailpoet_content\" align=\"center\" style=\"border-collapse:collapse\">
    <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
      <tbody>
      <tr>
        <td style=\"padding-left:0;padding-right:0;border-collapse:collapse\">
          <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mailpoet_cols-one\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0;border-collapse:collapse\">
            <tbody>
            <tr>
              <td class=\"mailpoet_spacer\" height=\"36\" valign=\"top\" style=\"border-collapse:collapse\"></td>
            </tr>
            <tr>
              <td class=\"mailpoet_image mailpoet_padded_vertical mailpoet_padded_side\" align=\"center\" valign=\"top\" style=\"border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                <img src=\"";
        // line 17
        echo $this->extensions['MailPoet\Twig\Assets']->generateCdnUrl("logo-orange-400x122.png");
        echo "\" width=\"80\" alt=\"new_logo_orange\" style=\"height:auto;max-width:100%;-ms-interpolation-mode:bicubic;border:0;display:block;outline:none;text-align:center\" />
              </td>
            </tr>
            <tr>
              <td class=\"mailpoet_spacer\" height=\"26\" valign=\"top\" style=\"border-collapse:collapse\"></td>
            </tr>
            <tr>
              <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                <h1 style=\"text-align:center;padding:0;font-style:normal;font-weight:normal;margin:0 0 12px;color:#111111;font-family:'Trebuchet MS','Lucida Grande','Lucida Sans Unicode','Lucida Sans',Tahoma,sans-serif;font-size:40px;line-height:64px\">
                  <strong>";
        // line 26
        echo $this->extensions['MailPoet\Twig\I18n']->translate("Your stats are in!");
        echo "</strong>
                </h1>
              </td>
            </tr>
            <tr>
              <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                <h3 class=\"title\" style=\"text-align:center;padding:0;font-style:normal;font-weight:normal;margin:0 0 6px;color:#333333;font-family:'Courier New',Courier,'Lucida Sans Typewriter','Lucida Typewriter',monospace;font-size:20px;line-height:32px\">
                  <em>";
        // line 33
        echo \MailPoetVendor\twig_escape_filter($this->env, ($context["subject"] ?? null), "html", null, true);
        echo "</em>
                </h3>
              </td>
            </tr>
            <tr>
              <td class=\"mailpoet_spacer\" height=\"55\" valign=\"top\" style=\"border-collapse:collapse\"></td>
            </tr>
            </tbody>
          </table>
        </td>
      </tr>
      </tbody>
    </table>
  </td>
  </tr>
  ";
        // line 48
        if (($context["subscribersLimitReached"] ?? null)) {
            // line 49
            echo "  <tr>
    <td class=\"mailpoet_content\" align=\"center\" style=\"border-collapse:collapse;background-color:#fe5301!important\" bgcolor=\"#fe5301\">
      <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0\">
        <tbody>
          <tr>
            <td style=\"border-collapse:collapse;padding-left:0;padding-right:0\">
              <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mailpoet_cols-one\" style=\"border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0\">
                <tbody>
  <tr>
    <td class=\"mailpoet_spacer\" height=\"26\" valign=\"top\" style=\"border-collapse:collapse\"></td>
  </tr>
  <tr>
    <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;word-break:break-word;word-wrap:break-word\">
      <table style=\"border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0\" width=\"100%\" cellpadding=\"0\">
    <tbody><tr>
      <td class=\"mailpoet_paragraph\" style=\"border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left\">
        <span style=\"color: #ffffff;\"><strong>";
            // line 65
            echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("Congratulations, you now have more than [subscribersLimit] subscribers!"), ["[subscribersLimit]" => ($context["subscribersLimit"] ?? null)]), "html", null, true);
            echo "</strong></span><br><br>
      </td>
    </tr></tbody></table>
<table style=\"border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0\" width=\"100%\" cellpadding=\"0\">
    <tbody><tr>
      <td class=\"mailpoet_paragraph\" style=\"border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left\">
        <span style=\"color: #ffffff;\"><strong></strong></span>
      </td>
    </tr></tbody></table>
<table style=\"border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0\" width=\"100%\" cellpadding=\"0\">
    <tbody><tr>
      <td class=\"mailpoet_paragraph\" style=\"border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left\">
        <span style=\"color: #ffffff;\">";
            // line 77
            echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("Our free version is limited to [subscribersLimit] subscribers. You need to upgrade now to be able to continue using MailPoet."), ["[subscribersLimit]" => ($context["subscribersLimit"] ?? null)]), "html", null, true);
            echo "</span>
      </td>
    </tr></tbody></table>
    </td>
  </tr>
  <tr>
    <td class=\"mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px\">
      <div>
        <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0\">
          <tbody><tr>
            <td class=\"mailpoet_button-container\" style=\"border-collapse:collapse;text-align:center\"><!--[if mso]>
              <v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\"
                href=\"\"
                style=\"height:50px;
                       width:288px;
                       v-text-anchor:middle;\"
                arcsize=\"6%\"
                strokeweight=\"0px\"
                strokecolor=\"#0074a2\"
                fillcolor=\"#ffffff\">
              <w:anchorlock/>
              <center style=\"color:#fe5301;
                font-family:Arial;
                font-size:20px;
                font-weight:bold;\">Upgrade Now
              </center>
              </v:roundrect>
              <![endif]--><a class=\"mailpoet_button\" href=\"";
            // line 104
            echo \MailPoetVendor\twig_escape_filter($this->env, ($context["upgradeNowLink"] ?? null), "html", null, true);
            echo "\" style=\"color:#fe5301;text-decoration:none !important;display:inline-block;-webkit-text-size-adjust:none;mso-hide:all;text-align:center;background-color:#ffffff;border-color:#0074a2;border-width:0px;border-radius:3px;border-style:solid;width:288px;line-height:50px;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:20px;font-weight:normal\"> Upgrade Now</a>
            </td>
          </tr>
        </tbody></table>
      </div>
    </td>
  </tr>
  <tr>
    <td class=\"mailpoet_spacer\" height=\"26\" valign=\"top\" style=\"border-collapse:collapse\"></td>
  </tr>
  <tr>
    <td class=\"mailpoet_spacer\" bgcolor=\"#ffffff\" height=\"26\" valign=\"top\" style=\"border-collapse:collapse\"></td>
  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>
  ";
        }
        // line 126
        echo "  <tr>
    <td class=\"mailpoet_content-cols-two\" align=\"left\" style=\"border-collapse:collapse\">
      <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
        <tbody>
        <tr>
          <td align=\"center\" style=\"font-size:0;border-collapse:collapse\">
            <!--[if mso]>
            <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
              <tbody>
              <tr>
                <td width=\"330\" valign=\"top\">
            <![endif]-->
            <div style=\"display:inline-block; max-width:330px; vertical-align:top; width:100%;\">
              <table width=\"330\" class=\"mailpoet_cols-two\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"width:100%;max-width:330px;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0;border-collapse:collapse\">
                <tbody>
                <tr>
                  <td class=\"mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                    <div>
                      <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
                        <tr>
                          <td class=\"mailpoet_button-container\" style=\"text-align:center;border-collapse:collapse\">
                            <a class=\"mailpoet_button\" href=\"\" style=\"display:inline-block;-webkit-text-size-adjust:none;mso-hide:all;text-decoration:none;text-align:center;background-color:";
        // line 147
        echo $this->extensions['MailPoet\Twig\Functions']->openedStatsColor(($context["opened"] ?? null));
        echo " ;border-color:#0074a2 ;border-width:0px ;border-radius:3px ;border-style:solid ;width:100px ;line-height:20px ;color:#ffffff ;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif ;font-size:10px ;font-weight:normal \">
                              ";
        // line 148
        echo $this->extensions['MailPoet\Twig\Functions']->openedStatsText(($context["opened"] ?? null));
        echo "
                            </a></td>
                        </tr>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-left:20px;padding-right:20px\">
                    <h2 style=\"text-align:center;padding:0;font-style:normal;font-weight:normal;margin:0 0 12px;color:#222222;font-family:'Courier New',Courier,'Lucida Sans Typewriter','Lucida Typewriter',monospace;font-size:40px;line-height:64px\">
                      <span style=\"color: ";
        // line 158
        echo $this->extensions['MailPoet\Twig\Functions']->openedStatsColor(($context["opened"] ?? null));
        echo ";\">
                        <strong>";
        // line 159
        echo number_format_i18n(($context["opened"] ?? null), 1);
        echo "%</strong>
                      </span>
                    </h2>
                  </td>
                </tr>
                <tr>
                  <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                    <table style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\" width=\"100%\" cellpadding=\"0\">
                      <tr>
                        <td class=\"mailpoet_paragraph\" style=\"word-break:break-word;word-wrap:break-word;text-align:center;border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px\">
                          <span style=\"color: ";
        // line 169
        echo $this->extensions['MailPoet\Twig\Functions']->openedStatsColor(($context["opened"] ?? null));
        echo "\">
                            ";
        // line 170
        echo $this->extensions['MailPoet\Twig\I18n']->translate("open rate");
        echo "
                          </span>
                        </td>
                      </tr></table>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!--[if mso]>
            </td>
            <td width=\"330\" valign=\"top\">
            <![endif]-->
            <div style=\"display:inline-block; max-width:330px; vertical-align:top; width:100%;\">
              <table width=\"330\" class=\"mailpoet_cols-two\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"width:100%;max-width:330px;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0;border-collapse:collapse\">
                <tbody>
                <tr>
                  <td class=\"mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                    <div>
                      <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
                        <tr>
                          <td class=\"mailpoet_button-container\" style=\"text-align:center;border-collapse:collapse\">
                            <a class=\"mailpoet_button\" href=\"\" style=\"display:inline-block;-webkit-text-size-adjust:none;mso-hide:all;text-decoration:none;text-align:center;background-color:";
        // line 192
        echo $this->extensions['MailPoet\Twig\Functions']->clickedStatsColor(($context["clicked"] ?? null));
        echo " ;border-color:#0074a2 ;border-width:0px ;border-radius:3px ;border-style:solid ;width:100px ;line-height:20px ;color:#ffffff ;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif ;font-size:10px ;font-weight:normal \">
                              ";
        // line 193
        echo $this->extensions['MailPoet\Twig\Functions']->clickedStatsText(($context["clicked"] ?? null));
        echo "
                            </a>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-left:20px;padding-right:20px\">
                    <h2 style=\"text-align:center;padding:0;font-style:normal;font-weight:normal;margin:0 0 12px;color:#222222;font-family:'Courier New',Courier,'Lucida Sans Typewriter','Lucida Typewriter',monospace;font-size:40px;line-height:64px\">
                      <span style=\"color: ";
        // line 204
        echo $this->extensions['MailPoet\Twig\Functions']->clickedStatsColor(($context["clicked"] ?? null));
        echo "\">
                        <strong>";
        // line 205
        echo number_format_i18n(($context["clicked"] ?? null), 1);
        echo "%</strong>
                      </span>
                    </h2>
                  </td>
                </tr>
                <tr>
                  <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                    <table style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\" width=\"100%\" cellpadding=\"0\">
                      <tr>
                        <td class=\"mailpoet_paragraph\" style=\"word-break:break-word;word-wrap:break-word;text-align:center;border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px\">
                          <span style=\"color: ";
        // line 215
        echo $this->extensions['MailPoet\Twig\Functions']->clickedStatsColor(($context["clicked"] ?? null));
        echo "\">
                            ";
        // line 216
        echo $this->extensions['MailPoet\Twig\I18n']->translate("click rate");
        echo "
                          </span>
                        </td>
                      </tr></table>
                  </td>
                </tr>
                </tbody>
              </table>
            </div><!--[if mso]>
            </td>
            </tr>
            </tbody>
            </table>
            <![endif]--></td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
  ";
        // line 235
        if ((($context["topLinkClicks"] ?? null) > 0)) {
            // line 236
            echo "  <tr>
    <td class=\"mailpoet_content\" align=\"center\" style=\"border-collapse:collapse\">
      <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
        <tbody>
        <tr>
          <td style=\"padding-left:0;padding-right:0;border-collapse:collapse\">
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mailpoet_cols-one\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0;border-collapse:collapse\">
              <tbody>
              <tr>
                <td class=\"mailpoet_divider\" valign=\"top\" style=\"padding:26.5px 20px 26.5px 20px;border-collapse:collapse\">
                  <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
                    <tr>
                      <td class=\"mailpoet_divider-cell\" style=\"border-top-width:1px;border-top-style:solid;border-top-color:#e8e8e8;border-collapse:collapse\">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              </tbody>
            </table>
          </td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
  <tr>
    <td class=\"mailpoet_content\" align=\"center\" style=\"border-collapse:collapse\">
      <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
        <tbody>
        <tr>
          <td style=\"padding-left:0;padding-right:0;border-collapse:collapse\">
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mailpoet_cols-one\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0;border-collapse:collapse\">
              <tbody>
              <tr>
                <td class=\"mailpoet_header_footer_padded mailpoet_header\" style=\"line-height:38.4px;text-align:center ;color:#222222 ;font-family:'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif ;font-size:24px ;border-collapse:collapse;padding:10px 20px\">
                  <span style=\"font-weight: 600;\">
                    ";
            // line 273
            echo $this->extensions['MailPoet\Twig\I18n']->translate("Most clicked link");
            echo "
                  </span>
                </td>
              </tr>
              <tr>
                <td class=\"mailpoet_text mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"word-break:break-word;word-wrap:break-word;padding-top:0;border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                  <table style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\" width=\"100%\" cellpadding=\"0\">
                    <tr>
                      <td class=\"mailpoet_paragraph\" style=\"word-break:break-word;word-wrap:break-word;text-align:center;border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px\">
                        ";
            // line 282
            if ((is_string($__internal_1ab96fedfd46b5c4874d8613941c5f4369b290887cb58cd35d3fea134b4185be = ($context["topLink"] ?? null)) && is_string($__internal_02421c649df9ad88f1f3a422d31249c3bb8f105b216a799c60ff65ba9fa61371 = "http") && ('' === $__internal_02421c649df9ad88f1f3a422d31249c3bb8f105b216a799c60ff65ba9fa61371 || 0 === strpos($__internal_1ab96fedfd46b5c4874d8613941c5f4369b290887cb58cd35d3fea134b4185be, $__internal_02421c649df9ad88f1f3a422d31249c3bb8f105b216a799c60ff65ba9fa61371)))) {
                // line 283
                echo "                        <a href=\"";
                echo \MailPoetVendor\twig_escape_filter($this->env, ($context["topLink"] ?? null), "html", null, true);
                echo "\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"color:#008282;text-decoration:underline\">
                          ";
                // line 284
                echo \MailPoetVendor\twig_escape_filter($this->env, ($context["topLink"] ?? null), "html", null, true);
                echo "
                        </a>
                        ";
            } else {
                // line 287
                echo "                        ";
                echo \MailPoetVendor\twig_escape_filter($this->env, ($context["topLink"] ?? null), "html", null, true);
                echo "
                        ";
            }
            // line 289
            echo "                      </td>
                    </tr></table>
                  <table style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\" width=\"100%\" cellpadding=\"0\">
                    <tr>
                      <td class=\"mailpoet_paragraph\" style=\"word-break:break-word;word-wrap:break-word;text-align:center;border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px\">
                        <span style=\"color: #000000;\">
                          ";
            // line 295
            echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("%s unique clicks"), ["%s" => ($context["topLinkClicks"] ?? null)]), "html", null, true);
            echo "
                        </span>
                      </td>
                    </tr></table>
                </td>
              </tr>
              </tbody>
            </table>
          </td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
  ";
        }
        // line 310
        echo "  <tr>
    <td class=\"mailpoet_content\" align=\"center\" style=\"border-collapse:collapse\">
      <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
        <tbody>
        <tr>
          <td style=\"padding-left:0;padding-right:0;border-collapse:collapse\">
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mailpoet_cols-one\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0;border-collapse:collapse\">
              <tbody>
              <tr>
                <td class=\"mailpoet_divider\" valign=\"top\" style=\"padding:6.5px 20px 6.5px 20px;border-collapse:collapse\">
                  <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
                    <tr>
                      <td class=\"mailpoet_divider-cell\" style=\"border-top-width:1px;border-top-style:solid;border-top-color:#e8e8e8;border-collapse:collapse\">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td class=\"mailpoet_spacer\" height=\"30\" valign=\"top\" style=\"border-collapse:collapse\"></td>
              </tr>
              <tr>
                <td class=\"mailpoet_padded_vertical mailpoet_padded_side\" valign=\"top\" style=\"border-collapse:collapse;padding-bottom:20px;padding-left:20px;padding-right:20px\">
                  <div>
                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse\">
                      <tr>
                        <td class=\"mailpoet_button-container\" style=\"text-align:center;border-collapse:collapse\">
                          <a class=\"mailpoet_button\" href=\"";
        // line 337
        echo \MailPoetVendor\twig_escape_filter($this->env, ($context["linkStats"] ?? null), "html", null, true);
        echo "\" style=\"display:inline-block;-webkit-text-size-adjust:none;mso-hide:all;text-decoration:none;text-align:center;background-color:#fe5301 ;border-color:#0074a2 ;border-width:0px ;border-radius:3px ;border-style:solid ;width:288px ;line-height:50px ;color:#ffffff ;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif ;font-size:20px ;font-weight:normal \">
                            ";
        // line 338
        echo $this->extensions['MailPoet\Twig\I18n']->translate("View all stats");
        echo "
                          </a></td>
                      </tr>
                    </table>
                  </div>
                </td>
              </tr>
              <tr>
                <td class=\"mailpoet_spacer\" height=\"20\" valign=\"top\" style=\"border-collapse:collapse\"></td>
              </tr>
              </tbody>
            </table>
          </td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
";
    }

    public function getTemplateName()
    {
        return "emails/statsNotification.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  473 => 338,  469 => 337,  440 => 310,  422 => 295,  414 => 289,  408 => 287,  402 => 284,  397 => 283,  395 => 282,  383 => 273,  344 => 236,  342 => 235,  320 => 216,  316 => 215,  303 => 205,  299 => 204,  285 => 193,  281 => 192,  256 => 170,  252 => 169,  239 => 159,  235 => 158,  222 => 148,  218 => 147,  195 => 126,  170 => 104,  140 => 77,  125 => 65,  107 => 49,  105 => 48,  87 => 33,  77 => 26,  65 => 17,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "emails/statsNotification.html", "/home/u481628193/domains/swiddly.com/public_html/wp-content/plugins/mailpoet/views/emails/statsNotification.html");
    }
}
