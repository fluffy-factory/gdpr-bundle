# Gdpr Bundle

## Installation

Install package
```
composer require fluffy-factory/gdpr-bundle
```

Install assets
```
php bin/console asset:install
```

## Configuration
```yaml
# config/packages/gdpr.yaml

gdpr:
  redirection_url: 'fluffy_gdpr' # If you don't specify a route, the user will be redirected to the route he is on.
  design:
    disable: false
    bg_color: '#292e33'
    text_color: '#ffffff'
    btn_deny_bg_color: '#D23A4B'
    btn_deny_text_color: '#ffffff'
    btn_allow_bg_color: '#0ED198'
    btn_allow_text_color: '#ffffff'

  cookies:
    my_cookie_required:
      name: cookie_name
      description: "description ..."
      detail: "expiration date ..."
      required: true
    my_cookie_optionnal:
      name: cookie_name_1
      description: "description ..."
      detail: "expiration date ..."
      required: false
```

---
**NOTE**  
If the design.disable property is true so the *style* attribute will not be added to template's elements.
---

### Route
The bundle provide the route 'fluffy_gdpr'. You can edit the content to explain your cookies and configure them.

```yaml
# config/routes/gdpr.yaml

gdpr:
  resource: "@GdprBundle/Controller/GdprController.php"
  type: annotation
```

```twig
# privacy.html.twig

{% block required_cookies_table %}
    <h2 id="params">{{ 'required_cookies_title'|trans({},'GdprBundle') }}</h2>
    <table>
        <thead>
        <tr>
            <th>Cookie</th>
            <th>{{ 'Description'|trans({},'GdprBundle') }}</th>
            <th>{{ 'Name'|trans({},'GdprBundle') }}</th>
        </tr>
        </thead>
        <tbody>
        {% for cookie in required_cookies %}
            <tr>
                <td>{{ cookie.name|trans({},'GdprBundle') }}</td>
                <td>{{ cookie.description|trans({},'GdprBundle') }}</td>
                <td>{{ cookie.detail|trans({},'GdprBundle') }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}

{% block optionnal_cookies_table %}
    <h2>{{ 'optionnal_cookies_title'|trans({},'GdprBundle') }}</h2>
    {{ form_start(form) }}
    {{ form_row(form) }}
    <button type="submit">send</button>
    {{ form_end(form) }}
{% endblock %}
```

##### Twig  
Add this script tag, the `cookies.js` script need it to knows which cookies write when the user accept or deny the privacy policy from the `cookie_bar.html.twig`
```twig
<head>
    <script type="text/javascript">
        var optionnalCookies = {{ getOptionnalCookiesNames() }}
    </script>
</head>

{% block javascripts %}
    <script src="{{ asset('bundles/gdpr/js/cookies.js') }}"></script>
{% endblock %}
```

Add stylesheets
```twig
{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('bundles/gdpr/css/style.css') }}">
{% endblock %}
```

**showCookieBar()** check if the user already has all your cookies from the configuration file.
```twig
{% if showCookieBar() %}
    {% include '@Gdpr/cookie_bar.html.twig' %}
{% endif %}
```

In case of optionnals cookies you can manage them in case-by-case with the twig function **allowedCookie('cookie_name')**
```twig
{% if allowedCookie('google_analytics') %}
   {# insert your code here ... #}
{% endif %}
```
