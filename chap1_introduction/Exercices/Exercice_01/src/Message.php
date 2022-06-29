<?php

namespace App;

class Message{

    public function __construct(
        private string $lang = 'fr',
        private array $translates = [
            'fr' => 'Bonjour tout le monde',
            'en' => 'Hello World'
        ]
    )
    {
        
    }

        /**
         * Get the value of lang
         *
         * @return string
         */
        public function getLang(): string
        {
                return $this->lang;
        }

        /**
         * Set the value of lang
         *
         * @param string $lang
         *
         * @return self
         */
        public function setLang(string $lang): self
        {
                $this->lang = $lang;

                return $this;
        }

        /**
         * Get the value of translates
         *
         * @return string
         */
        public function getTranslate(): string
        {
                return $this->translates[$this->lang];
        }

        /**
         * Set the value of translates
         *
         * @param string $translate
         *
         * @return self
         */
        public function setTranslate(string $lang, string $translate): self
        {
                $this->translates[$lang] = $translate;

                return $this;
        }

        public function __toString()
        {
            return $this->lang;
        }
}