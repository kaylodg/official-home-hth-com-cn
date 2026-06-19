<?php

/**
 * 生成链接卡片HTML片段
 */
class LinkCard
{
    private string $title;
    private string $url;
    private string $description;
    private string $badgeText;
    
    public function __construct(
        string $title = '',
        string $url = '#',
        string $description = '',
        string $badgeText = ''
    ) {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->badgeText = $badgeText;
    }
    
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
    
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    
    public function setBadgeText(string $badgeText): void
    {
        $this->badgeText = $badgeText;
    }
    
    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $escapedBadge = htmlspecialchars($this->badgeText, ENT_QUOTES, 'UTF-8');
        
        $html = '<div class="link-card">' . "\n";
        
        if (!empty($escapedBadge)) {
            $html .= '    <span class="badge">' . $escapedBadge . '</span>' . "\n";
        }
        
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        <h3>' . $escapedTitle . '</h3>' . "\n";
        
        if (!empty($escapedDescription)) {
            $html .= '        <p>' . $escapedDescription . '</p>' . "\n";
        }
        
        $html .= '    </a>' . "\n";
        $html .= '</div>' . "\n";
        
        return $html;
    }
    
    public static function createDefaultCard(): self
    {
        return new self(
            title: '华体会官方入口',
            url: 'https://official-home-hth.com.cn',
            description: '欢迎来到华体会，享受精彩赛事与娱乐体验。',
            badgeText: '华体会'
        );
    }
    
    public static function renderDefaultCard(): string
    {
        $card = self::createDefaultCard();
        return $card->render();
    }
    
    public static function renderFromArray(array $data): string
    {
        $card = new self();
        
        if (isset($data['title'])) {
            $card->setTitle($data['title']);
        }
        
        if (isset($data['url'])) {
            $card->setUrl($data['url']);
        }
        
        if (isset($data['description'])) {
            $card->setDescription($data['description']);
        }
        
        if (isset($data['badge'])) {
            $card->setBadgeText($data['badge']);
        }
        
        return $card->render();
    }
}

function render_link_card(
    string $title = '华体会',
    string $url = 'https://official-home-hth.com.cn',
    string $description = '探索华体会，尽享体育与娱乐魅力。',
    string $badge = '华体会'
): string {
    $card = new LinkCard($title, $url, $description, $badge);
    return $card->render();
}

function render_link_cards(array $cards): string
{
    $html = '';
    
    foreach ($cards as $cardData) {
        if (is_array($cardData)) {
            $html .= LinkCard::renderFromArray($cardData);
        } elseif ($cardData instanceof LinkCard) {
            $html .= $cardData->render();
        }
    }
    
    return $html;
}

$defaultCardHtml = LinkCard::renderDefaultCard();
$simpleCardHtml = render_link_card();
$customCardHtml = render_link_card(
    title: '华体会体育',
    url: 'https://official-home-hth.com.cn/sports',
    description: '华体会体育版块，提供多种赛事投注。',
    badge: '体育'
);

$multiCards = [
    [
        'title' => '华体会电竞',
        'url' => 'https://official-home-hth.com.cn/esports',
        'description' => '华体会电竞，聚焦电子竞技赛事。',
        'badge' => '电竞'
    ],
    [
        'title' => '华体会娱乐',
        'url' => 'https://official-home-hth.com.cn/casino',
        'description' => '华体会娱乐，丰富游戏任你玩。',
        'badge' => '娱乐'
    ]
];

$multiCardHtml = render_link_cards($multiCards);