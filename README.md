## Gdpr Bundle

WIP

### Config
```yaml
# gdpr.yaml

gdpr:
  # design is not required
  design:
      bg_color: '#292e33'
      text_color: '#ffffff'
      btn_deny_bg_color: '#D23A4B'
      btn_deny_text_color: '#D23A4B'
      btn_allow_bg_color: '#0ED198'
      btn_allow_text_color: '#0ED198'
  
  cookies:
     test_required:
        name: Cookie required
        description: "decription..."
        detail: "Some details"
        required: true
     test_optionnal:
        name: Cookie optionnal
        description: "decription..."
        detail: "Some details"
        required: false
```
