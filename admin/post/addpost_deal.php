<?php 
//����session
include_once '../include/checksession.php';
//1 �����ϴ��ļ�
//�ж��Ƿ����ļ��ϴ�
$new_name=''; //���ϴ��ļ�ʱ��Ҳ���ᱣ��
if($_FILES['feature']['error']==0){
	//�ļ��ϴ��ɹ��������������׺ �ƶ�·��
	//��ȡ�ļ��ĺ�׺��(���Ҵ����һ��.��λ��)
	$pos = strrpos($_FILES['feature']['name'],'.' );
	//��ȡ
	$ext = substr($_FILES['feature']['name'],$pos);

	//�޸��ļ���
	$new_name = '../uploads/'.time().rand(10000,99999).$ext;
	//�޸�Ĭ��·��
	move_uploaded_file($_FILES['feature']['tmp_name'],$new_name);

}

//2 ���ձ�������
$title = $_POST['title']; //���±���
$content = $_POST['content']; //�����ı���
$cate = $_POST['category'];//��������
$status = $_POST['status'];//״̬

/*echo $title;
echo $content;
echo $cate;
echo $status;
*/


//3 ��������Ҫ��ӽ�ȥ������
$time = time();//ʱ���
$click = rand(300,500); //���
$good = rand(100,300);  //����
$bad = rand(0,50);  //�����

//��ȡ�������ݵ�ǰ200���ַ�Ϊ����ժҪ
$desc = substr($content,0,200); //��$content�н�ȡ���ݣ����±�Ϊ0��ʼ��ȡ����ȡ��200
//��ȡ������session�е�id
$adminid = $_SESSION['id'];

//4 ����mysql����������д(���)sql���
include_once '../include/mysql.php';
//��д������µ�sql���
$sql = "insert into ali_article values(null,'$title','$desc','$content',$adminid,
'$cate',$time,
'$status','$click','$good','$bad','$new_name')";

//ִ��sql���
$res = mysql_query($sql);
//�ж�
if($res){
	echo "������³ɹ�";
	//��ת��posts.php
	header('refresh:2;url=posts.php');
}else{
	echo "�������ʧ��";
	header('refresh:2;url=addpost.php');
}



 ?>