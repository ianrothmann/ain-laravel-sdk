## Ain Laravel SDK

Try it out with the Ain Facade. Proper documentation will follow soon. Here are a few tasks:

```php
    public function tldr()
    {
        $result=\Ain::TLdr()
            ->text($this->story)
            ->get();

        dd($result);
    }


    public function summarize()
    {
        $result=\Ain::summarize()
            ->text($this->story)
            ->inFirstPerson()
            ->forTargetGradeLevel(2)
            ->force()
            ->get();

        dd($result);
    }

    public function keywords()
    {
        $result=\Ain::extractKeywords()
            ->fromText($this->story)
            ->get();

        dd($result);
    }

    public function themes()
    {
        $result=\Ain::extractThemes()
            ->fromText($this->story)
            ->forContext('A person tells a story')
            ->get();

        dd($result);
    }

    public function sentiment()
    {
        $result=\Ain::classifySentiment()
            ->forSentences(['I like my dog','I dont like winter'])
            ->get();

        dd($result);
    }

    public function grammar()
    {
        $result=\Ain::languageCheck()
            ->text($this->spelling)
            ->get();

        dd($result);
    }

    public function rewriter()
    {
        $result=\Ain::rewrite()
            ->text($this->story)
            ->withHighCreativity()
            ->get();

        dd($result);
    }

    public function splitNames()
    {
        $result=\Ain::splitNames()
            ->forList(['Ian Rothmann','Hill, Peter'])
            ->get();

        dd($result);
    }
```