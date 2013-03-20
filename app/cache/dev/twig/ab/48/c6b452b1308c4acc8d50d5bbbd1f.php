<?php

/* AcmeDemoBundle:Demo:hello.html.twig */
class __TwigTemplate_ab48c6b452b1308c4acc8d50d5bbbd1f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("AcmeDemoBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AcmeDemoBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 9
        $context["code"] = $this->env->getExtension('demo')->getCode($this);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, ("Hello " . (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"))), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <h1>Hello ";
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
        echo "!</h1>
";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Demo:hello.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 28,  110 => 22,  102 => 17,  90 => 32,  53 => 10,  34 => 5,  137 => 53,  129 => 45,  124 => 42,  113 => 29,  97 => 18,  76 => 17,  59 => 55,  100 => 59,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 111,  362 => 110,  360 => 109,  355 => 106,  341 => 105,  337 => 103,  322 => 101,  314 => 99,  312 => 98,  309 => 97,  305 => 95,  298 => 91,  294 => 90,  285 => 89,  283 => 88,  278 => 86,  268 => 85,  264 => 84,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  235 => 74,  229 => 73,  224 => 71,  220 => 70,  214 => 69,  208 => 68,  177 => 65,  169 => 60,  143 => 56,  140 => 55,  132 => 51,  128 => 49,  119 => 42,  107 => 36,  71 => 19,  38 => 6,  155 => 45,  135 => 50,  126 => 45,  114 => 42,  84 => 29,  70 => 20,  67 => 6,  61 => 12,  94 => 34,  89 => 16,  85 => 25,  75 => 23,  68 => 14,  56 => 11,  87 => 20,  21 => 2,  26 => 9,  93 => 17,  88 => 31,  78 => 26,  46 => 7,  27 => 4,  44 => 12,  31 => 3,  28 => 3,  196 => 90,  183 => 82,  171 => 61,  166 => 51,  163 => 50,  158 => 46,  156 => 66,  151 => 63,  142 => 34,  138 => 57,  136 => 56,  121 => 46,  117 => 19,  105 => 18,  91 => 31,  62 => 23,  49 => 19,  24 => 3,  25 => 3,  19 => 1,  79 => 18,  72 => 16,  69 => 25,  47 => 8,  40 => 6,  37 => 5,  22 => 2,  246 => 32,  157 => 56,  145 => 35,  139 => 50,  131 => 48,  123 => 47,  120 => 20,  115 => 43,  111 => 37,  108 => 19,  101 => 19,  98 => 31,  96 => 58,  83 => 14,  74 => 14,  66 => 15,  55 => 15,  52 => 10,  50 => 24,  43 => 7,  41 => 5,  35 => 5,  32 => 4,  29 => 3,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 84,  182 => 66,  176 => 64,  173 => 74,  168 => 72,  164 => 59,  162 => 57,  154 => 54,  149 => 51,  147 => 58,  144 => 53,  141 => 51,  133 => 55,  130 => 41,  125 => 44,  122 => 34,  116 => 30,  112 => 42,  109 => 61,  106 => 21,  103 => 37,  99 => 30,  95 => 34,  92 => 33,  86 => 15,  82 => 28,  80 => 19,  73 => 16,  64 => 13,  60 => 6,  57 => 12,  54 => 10,  51 => 14,  48 => 9,  45 => 13,  42 => 7,  39 => 9,  36 => 4,  33 => 3,  30 => 7,);
    }
}
