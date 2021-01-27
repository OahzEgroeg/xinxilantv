<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"/var/www/html/application/admin/view/collect/info.html";i:1538051258;s:53:"/var/www/html/application/admin/view/public/head.html";i:1522628860;s:53:"/var/www/html/application/admin/view/public/foot.html";i:1526021730;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?> - 苹果CMS</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/admin_style.css">
    <script type="text/javascript" src="/static/js/jquery.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION='v10';
    </script>
</head>
<body>
<div class="page-container p10">
    <form class="layui-form layui-form-pane" method="post" action="">
        <input id="collect_id" name="collect_id" type="hidden" value="<?php echo $info['collect_id']; ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">资源名称：</label>
            <div class="layui-input-block  ">
                <input type="text" class="layui-input" value="<?php echo $info['collect_name']; ?>" placeholder="" id="collect_name" name="collect_name">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">接口地址：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $info['collect_url']; ?>" placeholder="" id="collect_url" name="collect_url">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">附加参数：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $info['collect_param']; ?>" placeholder="" id="collect_param" name="collect_param">
            </div>
            <div class="layui-form-mid layui-word-aux" style="margin-left:110px; ">提示信息：一般&开头，例如老版xml格式采集下载地址需加入&ct=1</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">接口类型：</label>
            <div class="layui-input-block">
                <input name="collect_type" type="radio" value="1" title="xml" <?php if($info['collect_type'] == 1): ?>checked <?php endif; ?>>
                <input name="collect_type" type="radio" value="2" title="json" <?php if($info['collect_type'] != 1): ?>checked <?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">资源类型：</label>
            <div class="layui-input-block">
                <input name="collect_mid" type="radio" value="1" title="视频" <?php if($info['collect_mid'] == 1): ?>checked <?php endif; ?>>
                <input name="collect_mid" type="radio" value="2" title="文章" <?php if($info['collect_mid'] == 2): ?>checked <?php endif; ?>>
                <input name="collect_mid" type="radio" value="8" title="演员" <?php if($info['collect_mid'] == 8): ?>checked <?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" type="button" id="btnTest" >测 试</button>
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="true">保 存</button>
                <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">
    layui.use(['form', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

        // 验证
        form.verify({
            collect_name: function (value) {
                if (value == "") {
                    return "请输入资源名称";
                }
            },
            collect_url: function (value) {
                if (value == "") {
                    return "请输入接口地址";
                }
            }
        });


        $('#btnTest').click(function() {
            var that = $(this);
            var data = 'cjurl='+ $('#collect_url').val() + '&cjflag='+ '&ac=list';

            $.post("<?php echo url('test'); ?>",data,function(r){
                if(r.code==1){
                    layer.msg('测试类型成功，接口类型：'+ r.msg ,{time:1800});
                    if(r.msg=='json'){
                        $("input[name='collect_type'][value=2]").attr("checked",true);
                    }
                    else{
                        $("input[name='collect_type'][value=1]").attr("checked",true);
                    }
                    form.render('radio');
                }
                else{
                    layer.msg(r.msg,{time:1800});
                }
            });

        });

    });




</script>

</body>
</html>