# php 常用的一些扩展类库

> 更新完善中

> 以下类库都在`\\jliu\\helper`命名空间下

## 公共函数

```php
// 是否为手机号
isMobile('18888888888');

 
// 随机数
random($length, $numeric = false)

 
// 字符串截取，支持中文和其他编码
msubstr($str, $start, $length, $charset = "utf-8", $suffix = true)
```

## Random
> 随机数操作

```
// 生成随机数
Random::number($length)

// 生成唯一编号
Random::code()


```

## Validate
> 验证

```
// 验证手机号是否正确
Validate::isMobile($text)

// 验证密码是否正确
Validate::isPassword($password)

// 验证邮箱是否正确
Validate::isEmail($mail)

// 验证用户名是否正确
Validate::isUserName($username)

// 验证身份证号码格式是否正确
Validate::isIdCard($id_card)

```