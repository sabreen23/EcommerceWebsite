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

/* settings.html */
class __TwigTemplate_853ace471015fc65d9a110b4010e9123bf314e84ef374f3f0ae0907de11f8271 extends \MailPoetVendor\Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'translations' => [$this, 'block_translations'],
            'after_javascript' => [$this, 'block_after_javascript'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.html", "settings.html", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "  <div id=\"settings_container\"></div>

  <script type=\"text/javascript\">
    ";
        // line 8
        echo "      var mailpoet_woocommerce_active = ";
        echo json_encode((($context["is_woocommerce_active"] ?? null) == true));
        echo ";
      var mailpoet_members_plugin_active = ";
        // line 9
        echo json_encode((($context["is_members_plugin_active"] ?? null) == true));
        echo ";
      var mailpoet_is_new_user = ";
        // line 10
        echo json_encode((($context["is_new_user"] ?? null) == true));
        echo ";
      var mailpoet_settings = ";
        // line 11
        echo json_encode(($context["settings"] ?? null));
        echo ";
      var mailpoet_segments = ";
        // line 12
        echo json_encode(($context["segments"] ?? null));
        echo ";
      var mailpoet_pages = ";
        // line 13
        echo json_encode(($context["pages"] ?? null));
        echo ";
      var mailpoet_mss_key_valid = ";
        // line 14
        echo json_encode(($context["mss_key_valid"] ?? null));
        echo ";
      var mailpoet_premium_key_valid = ";
        // line 15
        echo json_encode(($context["premium_key_valid"] ?? null));
        echo ";
      var mailpoet_premium_plugin_installed = ";
        // line 16
        echo json_encode(($context["premium_plugin_installed"] ?? null));
        echo ";
      var mailpoet_premium_plugin_download_url = ";
        // line 17
        echo json_encode(($context["premium_plugin_download_url"] ?? null));
        echo ";
      var mailpoet_paths = ";
        // line 18
        echo json_encode(($context["paths"] ?? null));
        echo ";
      var mailpoet_built_in_captcha_supported = ";
        // line 19
        echo json_encode((($context["built_in_captcha_supported"] ?? null) == true));
        echo ";
      var mailpoet_free_plan_url = \"";
        // line 20
        echo $this->extensions['MailPoet\Twig\Functions']->addReferralId("https://www.mailpoet.com/free-plan");
        echo "\";
      var mailpoet_current_user_email = \"";
        // line 21
        echo \MailPoetVendor\twig_escape_filter($this->env, \MailPoetVendor\twig_get_attribute($this->env, $this->source, ($context["current_user"] ?? null), "user_email", [], "any", false, false, false, 21), "js", null, true);
        echo "\";
      var mailpoet_hosts = ";
        // line 22
        echo json_encode(($context["hosts"] ?? null));
        echo ";
    ";
        // line 24
        echo "    var mailpoet_beacon_articles = [
      '57f71d49c697911f2d323486',
      '57fb0e1d9033600277a681ca',
      '57f49a929033602e61d4b9f4',
      '57fb134cc697911f2d323e3b',
    ];
  </script>
";
    }

    // line 32
    public function block_translations($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "  ";
        echo $this->extensions['MailPoet\Twig\I18n']->localize(["settings" => $this->extensions['MailPoet\Twig\I18n']->translate("Settings"), "basicsTab" => $this->extensions['MailPoet\Twig\I18n']->translate("Basics"), "signupConfirmationTab" => $this->extensions['MailPoet\Twig\I18n']->translate("Sign-up Confirmation"), "sendWithTab" => $this->extensions['MailPoet\Twig\I18n']->translate("Send With..."), "wooCommerceTab" => $this->extensions['MailPoet\Twig\I18n']->translate("WooCommerce"), "advancedTab" => $this->extensions['MailPoet\Twig\I18n']->translate("Advanced"), "keyActivationTab" => $this->extensions['MailPoet\Twig\I18n']->translate("Key Activation"), "saveSettings" => $this->extensions['MailPoet\Twig\I18n']->translate("Save settings"), "settingsSaved" => $this->extensions['MailPoet\Twig\I18n']->translate("Settings saved"), "defaultSenderTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Default sender"), "defaultSenderDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("These email addresses will be selected by default for each new email."), "from" => $this->extensions['MailPoet\Twig\I18n']->translate("From"), "yourName" => $this->extensions['MailPoet\Twig\I18n']->translate("Your name"), "replyTo" => $this->extensions['MailPoet\Twig\I18n']->translate("Reply-to"), "subscribeInCommentsTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscribe in comments"), "subscribeInCommentsDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Visitors that comment on a post can subscribe to your list via a checkbox."), "subscribeInRegistrationTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscribe in registration form"), "subscribeInRegistrationDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Allow users who register as a WordPress user on your website to subscribe to a MailPoet list (in addition to the \"WordPress Users\" list). This also enables WordPress users to receive confirmation emails (if sign-up confirmation is enabled)."), "usersWillBeSubscribedTo" => $this->extensions['MailPoet\Twig\I18n']->translate("Users will be subscribed to these lists:"), "yesAddMe" => $this->extensions['MailPoet\Twig\I18n']->translate("Yes, add me to your mailing list"), "chooseList" => $this->extensions['MailPoet\Twig\I18n']->translate("Choose a list"), "manageSubTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Manage Subscription page"), "manageSubDescription1" => $this->extensions['MailPoet\Twig\I18n']->translate("When your subscribers click the \"Manage your subscription\" link, they will be directed to this page."), "manageSubDescription2" => $this->extensions['MailPoet\Twig\I18n']->translate("Want to use a custom Subscription page? Check out our [link]Knowledge Base[/link] for instructions."), "previewPage" => $this->extensions['MailPoet\Twig\I18n']->translate("Preview page"), "preview" => $this->extensions['MailPoet\Twig\I18n']->translate("Preview"), "subscribersCanChooseFrom" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscribers can choose from these lists:"), "leaveEmptyToDisplayAll" => $this->extensions['MailPoet\Twig\I18n']->translate("Leave this field empty to display all lists"), "unsubscribeTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Unsubscribe page"), "unsubscribeDescription1" => $this->extensions['MailPoet\Twig\I18n']->translate("When your subscribers click the \"Unsubscribe\" link, they will be directed to a confirmation page. After confirming, the success page will be shown. These pages must contain the [mailpoet_page] shortcode."), "unsubscribeDescription2" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("[link]Learn more about customizing these pages.[/link]", "Unsubscribe pages customization link"), "confirmationPageTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Confirmation page"), "successPageTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Success page"), "statsNotifsTitle" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Stats notifications", "name of a setting to automatically send statistics (newsletter open rate, click rate, etc) by email"), "statsNotifsDescription" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Enter the email address that should receive your newsletter’s stats 24 hours after it has been sent, or every first Monday of the month for Welcome Emails and WooCommerce Emails.", "Please reuse the current translations of “Welcome Emails”"), "newslettersAndPostNotifs" => $this->extensions['MailPoet\Twig\I18n']->translate("Newsletters and Post Notifications"), "welcomeAndWcEmails" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Welcome Emails and WooCommerce emails", "Please reuse the current translations of “Welcome Emails”"), "pleaseFillEmail" => $this->extensions['MailPoet\Twig\I18n']->translate("Please fill the email address."), "newSubscriberNotifsTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("New subscriber notifications"), "newSubscriberNotifsDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Enter the email address that should receive notifications when someone subscribes."), "yes" => $this->extensions['MailPoet\Twig\I18n']->translate("Yes"), "no" => $this->extensions['MailPoet\Twig\I18n']->translate("No"), "never" => $this->extensions['MailPoet\Twig\I18n']->translate("Never"), "archiveShortcodeTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Archive page shortcode"), "archiveShortcodeDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Paste this shortcode on a page to display a list of past newsletters."), "subscribersCountShortcodeTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Shortcode to display total number of subscribers"), "subscribersCountShortcodeDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Paste this shortcode on a post or page to display the total number of confirmed subscribers."), "gdprTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Be GDPR compliant"), "gdprDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("You need to comply with European law in regards to data privacy if you have European subscribers. Rest assured, it’s easy!"), "readGuide" => $this->extensions['MailPoet\Twig\I18n']->translate("Read our guide"), "invalidEmail" => $this->extensions['MailPoet\Twig\I18n']->translate("Invalid email address"), "enableSignupConfTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Enable sign-up confirmation"), "enableSignupConfDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("If you enable this option, your subscribers will first receive a confirmation email after they subscribe. Once they confirm their subscription (via this email), they will be marked as 'confirmed' and will begin to receive your email newsletters."), "readAboutDoubleOptIn" => $this->extensions['MailPoet\Twig\I18n']->translate("Read more about Double Opt-in confirmation."), "signupConfirmationIsMandatory" => $this->extensions['MailPoet\Twig\I18n']->translate("Sign-up confirmation is mandatory when using the MailPoet Sending Service."), "emailSubject" => $this->extensions['MailPoet\Twig\I18n']->translate("Email subject"), "emailContent" => $this->extensions['MailPoet\Twig\I18n']->translate("Email content"), "emailContentDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Don't forget to include:<br /><br />[activation_link]Confirm your subscription.[/activation_link]<br /><br />Optional: [lists_to_confirm]."), "confirmationPage" => $this->extensions['MailPoet\Twig\I18n']->translate("Confirmation page"), "confirmationPageDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("When subscribers click on the activation link, they will be redirected to this page."), "subscribersNeedToActivateSub" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscribers will need to activate their subscription via email in order to receive your newsletters. This is highly recommended!"), "newSubscribersAutoConfirmed" => $this->extensions['MailPoet\Twig\I18n']->translate("New subscribers will be automatically confirmed, without having to confirm their subscription. This is not recommended!"), "bounceEmail" => $this->extensions['MailPoet\Twig\I18n']->translate("Bounce email address"), "yourBouncedEmails" => $this->extensions['MailPoet\Twig\I18n']->translate("Your bounced emails will be sent to this address."), "readMore" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Read more.", "support article link label"), "taskCron" => $this->extensions['MailPoet\Twig\I18n']->translate("Newsletter task scheduler (cron)"), "taskCronDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Select what will activate your newsletter queue."), "websiteVisitors" => $this->extensions['MailPoet\Twig\I18n']->translate("Visitors to your website (recommended)"), "mailpoetScript" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet's own script. Doesn't work with [link]these hosts[/link]."), "serverCron" => $this->extensions['MailPoet\Twig\I18n']->translate("Server side cron (Linux cron)"), "addCommandToCrontab" => $this->extensions['MailPoet\Twig\I18n']->translate("To use this option please add this command to your crontab:"), "withFrequency" => $this->extensions['MailPoet\Twig\I18n']->translate("With the frequency of running it every minute:"), "rolesTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Roles and capabilities"), "rolesDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Manage which WordPress roles access which features of MailPoet."), "manageUsingMembers" => $this->extensions['MailPoet\Twig\I18n']->translate("Manage using the Members plugin"), "installMembers" => $this->extensions['MailPoet\Twig\I18n']->translate("Install the plugin [link]Members[/link] (free) to manage permissions."), "trackingTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Open and click tracking"), "trackingDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Enable or disable open and click tracking."), "transactionalTitle" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Send all site’s emails with…", "Transational emails settings title"), "transactionalDescription" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Choose which method to send all your WordPress emails (e.g. password reset, new registration, WooCommerce invoices, etc.).", "Transational emails settings description"), "transactionalLink" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Read more.", "Transactional emails settings link"), "transactionalCurrentMethod" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("The current sending method - %1\$s (recommended)", "Transactional emails settings option"), "transactionalMssNote" => $this->extensions['MailPoet\Twig\I18n']->translate("Note: attachments, CC, BCC and multiple TO are not supported. [link]Learn more[/link]"), "transactionalWP" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("The default WordPress sending method (default)", "Transactional emails settings option"), "inactiveSubsTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Stop sending to inactive subscribers"), "inactiveSubsDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Gmail, Yahoo and other email providers will treat your emails like spam if your subscribers don't open your emails in the long run. This option will mark your subscribers as Inactive and MailPoet will stop sending to them."), "disabledBecauseTrackingIs" => $this->extensions['MailPoet\Twig\I18n']->translate("This option is disabled because tracking is disabled."), "after3months" => $this->extensions['MailPoet\Twig\I18n']->translate("After 3 months (recommended if you send once a day)"), "after6months" => $this->extensions['MailPoet\Twig\I18n']->translate("After 6 months (default, recommended if you send at least once a month)"), "after12months" => $this->extensions['MailPoet\Twig\I18n']->translate("After 12 months"), "libs3rdPartyTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Load 3rd-party libraries"), "libs3rdPartyDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("E.g. Google Fonts (used in Form Editor) and HelpScout (used for support). This needs to be enabled if you want to be able to contact support."), "shareDataTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Share anonymous data"), "shareDataDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Share anonymous data and help us improve the plugin. We appreciate your help!"), "captchaTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Protect your forms against spam signups"), "captchaDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Built-in CAPTCHA protects your subscription forms after a second signup attempt by a bot. Alternatively, use reCAPTCHA by Google."), "signupForCaptchaKey" => $this->extensions['MailPoet\Twig\I18n']->translate("Sign up for an API key pair here."), "builtInCaptcha" => $this->extensions['MailPoet\Twig\I18n']->translate("Built-in captcha (default)"), "disbaledBecauseExtensionMissing" => $this->extensions['MailPoet\Twig\I18n']->translate("(disabled because GD or FreeType extension is missing)"), "googleReCaptcha" => $this->extensions['MailPoet\Twig\I18n']->translate("Google reCAPTCHA v2"), "yourReCaptchaKey" => $this->extensions['MailPoet\Twig\I18n']->translate("Your reCAPTCHA Site Key"), "yourReCaptchaSecret" => $this->extensions['MailPoet\Twig\I18n']->translate("Your reCAPTCHA Secret Key"), "fillReCaptchaKeys" => $this->extensions['MailPoet\Twig\I18n']->translate("Please fill the reCAPTCHA keys."), "disable" => $this->extensions['MailPoet\Twig\I18n']->translate("Disable"), "recalculateSubscribersScoreTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Recalculate Subscriber Scores"), "recalculateSubscribersScoreDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet will recalculate subscriber engagement scores for all subscribers. This may take some time to complete."), "recalculateSubscribersScoreNow" => $this->extensions['MailPoet\Twig\I18n']->translate("Update now…"), "recalculateSubscribersScoreNotice" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscriber score recalculation has been scheduled and will start soon. It may take some time to complete."), "reinstallTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Reinstall from scratch"), "reinstallDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Want to start from the beginning? This will completely delete MailPoet and reinstall it from scratch. Remember: you will lose all of your data!"), "reinstallNow" => $this->extensions['MailPoet\Twig\I18n']->translate("Reinstall now..."), "loggingTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Logging"), "loggingDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Enables logging for diagnostics of plugin behavior."), "loggingDescriptionLink" => $this->extensions['MailPoet\Twig\I18n']->translate("See logs."), "everythingLogOption" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Everything", "In settings: \"Logging: Everything\""), "errorsLogOption" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Errors only", "In settings: \"Logging: Errors only\""), "nothingLogOption" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Nothing", "In settings: \"Logging: Nothing\""), "reinstallConfirmation" => $this->extensions['MailPoet\Twig\I18n']->translate("Are you sure? All of your MailPoet data will be permanently erased (newsletters, statistics, subscribers, etc.)."), "announcementHeader" => $this->extensions['MailPoet\Twig\I18n']->translate("Get notified when someone subscribes"), "announcementParagraph1" => $this->extensions['MailPoet\Twig\I18n']->translate("It’s been a popular feature request from our users, we hope you get lots of emails about all your new subscribers!"), "announcementParagraph2" => $this->extensions['MailPoet\Twig\I18n']->translate("(You can turn this feature off if it’s too many emails.)"), "premiumTabActivationKeyLabel" => $this->extensions['MailPoet\Twig\I18n']->translate("Activation Key", "mailpoet"), "premiumTabDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("This key is used to validate your free or paid subscription. Paying customers will enjoy automatic upgrades of their Premium plugin and access to faster support.", "mailpoet"), "premiumTabNoKeyNotice" => $this->extensions['MailPoet\Twig\I18n']->translate("Please specify a license key before validating it.", "mailpoet"), "premiumTabVerifyButton" => $this->extensions['MailPoet\Twig\I18n']->translate("Verify", "mailpoet"), "premiumTabKeyValidMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Your key is valid", "mailpoet"), "premiumTabKeyNotValidMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Your key is not valid", "mailpoet"), "premiumTabKeyCannotValidate" => $this->extensions['MailPoet\Twig\I18n']->translate("Yikes, we can’t validate your key because:"), "premiumTabKeyCannotValidateLocalhost" => $this->extensions['MailPoet\Twig\I18n']->translate("You’re on localhost or using an IP address instead of a domain. Not allowed for security reasons!"), "premiumTabKeyCannotValidateBlockingHost" => $this->extensions['MailPoet\Twig\I18n']->translate("Your host is blocking the activation, e.g. Altervista"), "premiumTabKeyCannotValidateIntranet" => $this->extensions['MailPoet\Twig\I18n']->translate("This website is on an Intranet. Activating MailPoet will not be possible."), "learnMore" => $this->extensions['MailPoet\Twig\I18n']->translate("Learn more"), "premiumTabPremiumActiveMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet Premium is active", "mailpoet"), "premiumTabPremiumNotInstalledMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet Premium is not installed.", "mailpoet"), "premiumTabPremiumDownloadMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Download MailPoet Premium plugin", "mailpoet"), "premiumTabPremiumInstallationInstallingMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("downloading MailPoet Premium…", "mailpoet"), "premiumTabPremiumInstallationActivatingMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("activating MailPoet Premium…", "mailpoet"), "premiumTabPremiumInstallationActiveMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet Premium is active!", "mailpoet"), "premiumTabPremiumInstallationErrorMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Something went wrong. Please [link]download the Premium plugin from your account[/link] and [link]contact our support team[/link].", "mailpoet"), "premiumTabPremiumKeyNotValidMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Your key is not valid for MailPoet Premium", "mailpoet"), "premiumTabMssActiveMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet Sending Service is active", "mailpoet"), "premiumTabMssNotActiveMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet Sending Service is not active.", "mailpoet"), "premiumTabMssActivateMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Activate MailPoet Sending Service", "mailpoet"), "premiumTabMssKeyNotValidMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Your key is not valid for the MailPoet Sending Service", "mailpoet"), "premiumTabPendingApprovalHeading" => $this->extensions['MailPoet\Twig\I18n']->translate("Note: your account is pending approval by MailPoet.", "mailpoet"), "premiumTabPendingApprovalMessage" => $this->extensions['MailPoet\Twig\I18n']->translate("Rest assured, this only takes just a couple of hours. Until then, you can still send email previews to yourself. Any active automatic emails, like Welcome Emails, will be paused.", "mailpoet"), "premiumTabCongratulatoryMssEmailSent" => $this->extensions['MailPoet\Twig\I18n']->translate("A test email was sent to [email_address]", "mailpoet"), "wcCustomizerTitle" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Use MailPoet to customize WooCommerce emails", "Setting for using our editor for WooCommerce email"), "wcCustomizerDescription" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("You can use the MailPoet editor to customize the template used to send WooCommerce emails (notification for order processing, completed, ...).", "Setting for using our editor for WooCommerce email"), "openTemplateEditor" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Open template editor", "Settings button to go to WooCommerce email editor"), "wcOptinTitle" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Opt-in on checkout", "settings area: add an email opt-in checkbox on the checkout page (e-commerce websites)"), "wcOptinDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Customers can subscribe to the \"WooCommerce Customers\" list and optionally other lists via a checkbox on the checkout page."), "wcOptinSegmentsTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Lists to also subscribe customers to:"), "leaveEmptyToSubscribeToWCCustomers" => $this->extensions['MailPoet\Twig\I18n']->translate("Leave empty to subscribe only to \"WooCommerce Customers\" list"), "wcOptinSegmentsPlaceholder" => $this->extensions['MailPoet\Twig\I18n']->translate("Select lists..."), "wcOptinMsgTitle" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Checkbox opt-in message", "settings area: set the email opt-in message on the checkout page (e-commerce websites)"), "wcOptinMsgDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("This is the checkbox message your customers will see on your WooCommerce checkout page to subscribe to the \"WooCommerce Customers\" list and lists selected in \"Opt-in on checkout\" setting."), "wcOptinMsgPlaceholder" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Checkbox opt-in message", "placeholder text for the WooCommerce checkout opt-in message"), "wcOptinMsgCannotBeEmpty" => $this->extensions['MailPoet\Twig\I18n']->translate("The checkbox opt-in message cannot be empty."), "subscribeOldWCTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscribe old WooCommerce customers"), "subscribeOldWCDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Subscribe all my past customers to this list because they agreed to receive marketing emails from me."), "enableCookiesTitle" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("Enable browser cookies", "Option in settings page: the user can accept or forbid MailPoet to use browser cookies"), "enableCookiesDescription" => $this->extensions['MailPoet\Twig\I18n']->translateWithContext("If you enable this option, MailPoet will use browser cookies for more precise WooCommerce tracking. This is practical for abandoned cart emails for example.", "Browser cookies are data created by websites and stored in visitors web browser"), "mssTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("MailPoet Sending Service"), "youreSendingWithMss" => $this->extensions['MailPoet\Twig\I18n']->translate("You're now sending with MailPoet!"), "solveSendingProblems" => $this->extensions['MailPoet\Twig\I18n']->translate("Solve all of your sending problems!"), "mssBenefit1" => $this->extensions['MailPoet\Twig\I18n']->translate("Reach the inbox, not the spam box."), "mssBenefit2" => $this->extensions['MailPoet\Twig\I18n']->translate("Easy configuration: enter a key to activate the sending service."), "mssBenefit3" => $this->extensions['MailPoet\Twig\I18n']->translate("Super fast: send up to 50,000 emails per hour."), "mssBenefit4" => $this->extensions['MailPoet\Twig\I18n']->translate("All emails are signed with SPF & DKIM."), "mssBenefit5" => $this->extensions['MailPoet\Twig\I18n']->translate("Automatically remove invalid and bounced addresses (bounce handling) to keep your lists clean."), "seeVideo" => $this->extensions['MailPoet\Twig\I18n']->translate("See video guide"), "activate" => $this->extensions['MailPoet\Twig\I18n']->translate("Activate"), "activated" => $this->extensions['MailPoet\Twig\I18n']->translate("Activated"), "freeUpto" => $this->extensions['MailPoet\Twig\I18n']->translate("Free up to 1,000 subscribers"), "or" => $this->extensions['MailPoet\Twig\I18n']->translate("or"), "enterYourKey" => $this->extensions['MailPoet\Twig\I18n']->translate("[link]enter your key[/link]"), "otherTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Other"), "sendViaHost" => $this->extensions['MailPoet\Twig\I18n']->translate("Send emails via your host"), "notRecommended" => $this->extensions['MailPoet\Twig\I18n']->translate("(not recommended!)"), "orViaThirdParty" => $this->extensions['MailPoet\Twig\I18n']->translate("or via a third-party sender."), "invalidKeyForMss" => $this->extensions['MailPoet\Twig\I18n']->translate("Your key is not valid for MailPoet Sending Service."), "getPlan" => $this->extensions['MailPoet\Twig\I18n']->translate("Get a new plan"), "otherCons1" => $this->extensions['MailPoet\Twig\I18n']->translate("Unless you're a pro, you’ll probably end up in spam."), "otherCons2" => $this->extensions['MailPoet\Twig\I18n']->translate("Sending speed is limited by your host and/or your third-party (with a 2,000 per hour maximum)."), "otherCons3" => $this->extensions['MailPoet\Twig\I18n']->translate("Manual configuration of SPF and DKIM required."), "otherCons4" => $this->extensions['MailPoet\Twig\I18n']->translate("Bounce handling is available, but only with an extra [link]add-on[/link]."), "configure" => $this->extensions['MailPoet\Twig\I18n']->translate("Configure"), "method" => $this->extensions['MailPoet\Twig\I18n']->translate("Method"), "hostOption" => $this->extensions['MailPoet\Twig\I18n']->translate("Your web host / web server"), "smtpOption" => $this->extensions['MailPoet\Twig\I18n']->translate("SMTP"), "selectProvider" => $this->extensions['MailPoet\Twig\I18n']->translate("Select your provider"), "yourHost" => $this->extensions['MailPoet\Twig\I18n']->translate("Your web host"), "notListed" => $this->extensions['MailPoet\Twig\I18n']->translate("Not listed (default)"), "sendingFrequency" => $this->extensions['MailPoet\Twig\I18n']->translate("Sending frequency"), "recommendedTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("Recommended"), "recommended" => $this->extensions['MailPoet\Twig\I18n']->translate("recommended"), "ownFrequency" => $this->extensions['MailPoet\Twig\I18n']->translate("I'll set my own frequency"), "emails" => $this->extensions['MailPoet\Twig\I18n']->translate("emails"), "xEmails" => $this->extensions['MailPoet\Twig\I18n']->translate("%1\$s emails"), "everyMinute" => $this->extensions['MailPoet\Twig\I18n']->translate("every minute"), "everyMinutes" => $this->extensions['MailPoet\Twig\I18n']->translate("every %1\$d minutes"), "everyHour" => $this->extensions['MailPoet\Twig\I18n']->translate("every hour"), "everyHours" => $this->extensions['MailPoet\Twig\I18n']->translate("every %1\$d hours"), "thatsXEmailsPerDay" => $this->extensions['MailPoet\Twig\I18n']->translate("That's <strong>%1\$s emails</strong> per day"), "thatsXEmailsPerSecond" => $this->extensions['MailPoet\Twig\I18n']->translate("That's %1\$s emails per second. <strong>We highly recommend to send 1 email per second, at the absolute maximum.</strong> MailPoet needs at least one second to process and send a single email (on most hosts.) <strong>Alternatively, send with MailPoet, which can be up to 50 times faster.</strong>"), "frequencyWarning" => $this->extensions['MailPoet\Twig\I18n']->translate("<strong>Warning!</strong> You may break the terms of your web host or provider by sending more than the recommended emails per day. Contact your host if you want to send more."), "smtpHost" => $this->extensions['MailPoet\Twig\I18n']->translate("SMTP Hostname"), "smtpHostExample" => $this->extensions['MailPoet\Twig\I18n']->translate("e.g.: smtp.mydomain.com"), "smtpPort" => $this->extensions['MailPoet\Twig\I18n']->translate("SMTP Port"), "region" => $this->extensions['MailPoet\Twig\I18n']->translate("Region"), "accessKey" => $this->extensions['MailPoet\Twig\I18n']->translate("Access Key"), "secretKey" => $this->extensions['MailPoet\Twig\I18n']->translate("Secret Key"), "apiKey" => $this->extensions['MailPoet\Twig\I18n']->translate("API Key"), "login" => $this->extensions['MailPoet\Twig\I18n']->translate("Login"), "password" => $this->extensions['MailPoet\Twig\I18n']->translate("Password"), "secureConnectioon" => $this->extensions['MailPoet\Twig\I18n']->translate("Secure Connection"), "authentication" => $this->extensions['MailPoet\Twig\I18n']->translate("Authentication"), "authenticationDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("Leave this option set to Yes. Only a tiny portion of SMTP services prefer Authentication to be turned off."), "spfTitle" => $this->extensions['MailPoet\Twig\I18n']->translate("SPF Signature (Highly recommended!)"), "spfDescription" => $this->extensions['MailPoet\Twig\I18n']->translate("This improves your delivery rate by verifying that you're allowed to send emails from your domain."), "spfSetup" => $this->extensions['MailPoet\Twig\I18n']->translate("SPF is set up in your DNS. Read your host's support documentation for more information."), "testSending" => $this->extensions['MailPoet\Twig\I18n']->translate("Test the sending method"), "sendTestEmail" => $this->extensions['MailPoet\Twig\I18n']->translate("Send a test email"), "testEmailTooltip" => $this->extensions['MailPoet\Twig\I18n']->translate("Didn't receive the test email? Read our [link]quick guide[/link] to sending issues."), "cantSendEmail" => $this->extensions['MailPoet\Twig\I18n']->translate("The email could not be sent. Make sure the option \"Email notifications\" has a FROM email address in the Basics tab."), "testEmailSubject" => $this->extensions['MailPoet\Twig\I18n']->translate("This is a Sending Method Test"), "testEmailBody" => $this->extensions['MailPoet\Twig\I18n']->translate("Yup, it works! You can start blasting away emails to the moon."), "emailSent" => $this->extensions['MailPoet\Twig\I18n']->translate("The email has been sent! Check your inbox."), "orCancel" => $this->extensions['MailPoet\Twig\I18n']->translate("or Cancel")]);
        // line 284
        echo "
";
    }

    // line 287
    public function block_after_javascript($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 288
        echo $this->extensions['MailPoet\Twig\Assets']->generateJavascript("settings.js");
        echo "
";
    }

    public function getTemplateName()
    {
        return "settings.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 288,  141 => 287,  136 => 284,  133 => 33,  129 => 32,  118 => 24,  114 => 22,  110 => 21,  106 => 20,  102 => 19,  98 => 18,  94 => 17,  90 => 16,  86 => 15,  82 => 14,  78 => 13,  74 => 12,  70 => 11,  66 => 10,  62 => 9,  57 => 8,  52 => 4,  48 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "settings.html", "/home/u481628193/domains/swiddly.com/public_html/wp-content/plugins/mailpoet/views/settings.html");
    }
}