<pre>
<?php
class Counter{
    private static $c = 0;

    final public static function increment(){
        return ++self::$c;
    }
}

// �������� ���������� ������ ReflectionMethod
$method = new ReflectionMethod('Counter', 'increment');
exit;



// ����� �������� ����������
printf(
    "===> %s%s%s%s%s%s%s ����� '%s' (������� �������� %s)\n" .
    "     �������� � %s\n" .
    "     ������ � %d �� %d\n" .
    "     ����� ������������ %d[%s]\n",
        $method->isInternal() ? '����������' : '����������������',
        $method->isAbstract() ? ' �����������' : '',
        $method->isFinal() ? ' ���������' : '',
        $method->isPublic() ? ' public' : '',
        $method->isPrivate() ? ' private' : '',
        $method->isProtected() ? ' protected' : '',
        $method->isStatic() ? ' �����������' : '',
        $method->getName(),
        $method->isConstructor() ? '�������������' : '������� �������',
        $method->getFileName(),
        $method->getStartLine(),
        $method->getEndline(),
        $method->getModifiers(),
        implode(' ', Reflection::getModifierNames($method->getModifiers()))
);

// ����� ����������� ����������, ���� ��� ����
if ($statics= $method->getStaticVariables()) {
    printf("---> ����������� ����������: %s\n", var_export($statics, 1));
}
exit;


// ����� ������
printf("---> ��������� ������: ");
$result = $method->invoke(null);
echo $result;
?>
</pre>