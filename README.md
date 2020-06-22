##alfred workflow

### 仓库目的
1. 学习alfred workflow插件开发
2. 开发自己使用的workflow


### 开发步骤
1. 以php脚本开发为例,alfred 创建workflow 选择 input->script filter
2. 输入关键字,以及一些提示信息,之后选择php脚本,参数选择 {query} ![](http://img.justwkj.com/20200622100210.png)
3. 脚本内容根据实际修改,输入如下:
    ```php
    $query = urlencode( "{query}" );
    require_once("gitmoji.php");
    ```
4. 保存之后选择,列表的workflow右击打开文件所在目录 ![](http://img.justwkj.com/20200622100602.png) ![](http://img.justwkj.com/20200622100646.png)
5. 可以直接在当前目录开发,由于目录比较深,通常不在该目录开发.选择自己开发目录
  之后打包成xxx.workflow就可以自动安装在当前目录了
6. 复制上面目录的文件,到我们常用的开发目录下,新创建一个如gitmoji的目录,复制需要的类库
   把demo下的所有文件复制到gitmoji目录下,创建 gitmoji.php. gitmoji.php就是实际开发的内容
7. demo目录文件解释:  
    - workflows.php 是别人封装的一个用于开发workflow的类库
    - /bin/build.php 用来打包代码为 xxx.workflow文件的,方便安装
8. 打包时,需要根据实际修改build.php的内容, 打包命令 `php ./bin/build.php`