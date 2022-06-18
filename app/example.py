import requests
json_data = {'data':'6JCX520','section':'A3'}
x = requests.post(url='http://localhost/otopark-projesi/control.php', json=json_data)

print(x.text)


#| A3      | 8CRM824  |
#| B14     | 8EGJ271  |
#| B18     | 46HY084  |
#| B21     | 8KA849   |
#| B22     | 6JCX520  |
#| C3      | 34FZR153 |
#| C4      | 12TY987  |
#| A12     | 12TY987  |
#| B1      | 12TY987  |
#| B2      | 12TY987  |
