# 商品管理系统

本系统提供简单的商品信息管理，包括对商品的增、删、改、查等操作。

商品详细信息如下：

```
structs goods { 
    id unsigned int // 商品ID
    name string // 商品名称
    price int   // 商品单价
    total int   // 商品数量
    type_id int // 商品类别
    pic string  // 图片名称
    note string // 备注
    add_time string // 商品添加时间
}
```
