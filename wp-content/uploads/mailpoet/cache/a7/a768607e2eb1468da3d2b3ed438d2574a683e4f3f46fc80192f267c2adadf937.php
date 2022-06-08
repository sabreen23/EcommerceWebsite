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

/* emails/statsNotification.txt */
class __TwigTemplate_a8037137d6132746427b8cfe3a78c4333f14547dd90b0ccfcb9fbd4ed0bfd61b extends \MailPoetVendor\Twig\Template
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
        return "emails/statsNotificationLayout.txt";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("emails/statsNotificationLayout.txt", "emails/statsNotification.txt", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo $this->extensions['MailPoet\Twig\I18n']->translate("Your stats are in!");
        echo "

";
        // line 6
        echo \MailPoetVendor\twig_escape_filter($this->env, ($context["subject"] ?? null), "html", null, true);
        echo "

";
        // line 8
        if (($context["subscribersLimitReached"] ?? null)) {
            // line 9
            echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("Congratulations, you now have more than [subscribersLimit] subscribers!"), ["[subscribersLimit]" => ($context["subscribersLimit"] ?? null)]), "html", null, true);
            echo "

";
            // line 11
            if (($context["hasValidApiKey"] ?? null)) {
                // line 12
                echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("Your plan is limited to [subscribersLimit] subscribers."), ["[subscribersLimit]" => ($context["subscribersLimit"] ?? null)]), "html", null, true);
                echo "
";
            } else {
                // line 14
                echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("Our free version is limited to [subscribersLimit] subscribers."), ["[subscribersLimit]" => ($context["subscribersLimit"] ?? null)]), "html", null, true);
                echo "
";
            }
            // line 16
            echo $this->extensions['MailPoet\Twig\I18n']->translate("You need to upgrade now to be able to continue using MailPoet.");
            echo "

";
            // line 18
            echo $this->extensions['MailPoet\Twig\I18n']->translate("Upgrade Now");
            echo "
  ";
            // line 19
            echo \MailPoetVendor\twig_escape_filter($this->env, ($context["upgradeNowLink"] ?? null), "html", null, true);
            echo "
";
        }
        // line 21
        echo "
";
        // line 22
        echo $this->extensions['MailPoet\Twig\I18n']->translate("open rate");
        echo ": ";
        echo number_format_i18n(($context["opened"] ?? null));
        echo "%
  ";
        // line 23
        echo $this->extensions['MailPoet\Twig\Functions']->openedStatsText(($context["opened"] ?? null));
        echo "

";
        // line 25
        echo $this->extensions['MailPoet\Twig\I18n']->translate("click rate");
        echo ": ";
        echo number_format_i18n(($context["clicked"] ?? null));
        echo "%
  ";
        // line 26
        echo $this->extensions['MailPoet\Twig\Functions']->clickedStatsText(($context["opened"] ?? null));
        echo "

";
        // line 28
        if ((($context["topLinkClicks"] ?? null) > 0)) {
            // line 29
            echo $this->extensions['MailPoet\Twig\I18n']->translate("Most clicked link");
            echo "
  ";
            // line 30
            echo \MailPoetVendor\twig_escape_filter($this->env, ($context["topLink"] ?? null), "html", null, true);
            echo "

  ";
            // line 32
            echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_replace_filter($this->extensions['MailPoet\Twig\I18n']->translate("%s unique clicks"), ["%s" => ($context["topLinkClicks"] ?? null)]), "html", null, true);
            echo "
";
        }
        // line 34
        echo "
";
        // line 35
        echo $this->extensions['MailPoet\Twig\I18n']->translate("View all stats");
        echo "
  ";
        // line 36
        echo \MailPoetVendor\twig_escape_filter($this->env, ($context["linkStats"] ?? null), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "emails/statsNotification.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 36,  137 => 35,  134 => 34,  129 => 32,  124 => 30,  120 => 29,  118 => 28,  113 => 26,  107 => 25,  102 => 23,  96 => 22,  93 => 21,  88 => 19,  84 => 18,  79 => 16,  74 => 14,  69 => 12,  67 => 11,  62 => 9,  60 => 8,  55 => 6,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "emails/statsNotification.txt", "/home/u481628193/domains/swiddly.com/public_html/wp-content/plugins/mailpoet/views/emails/statsNotification.txt");
    }
}
