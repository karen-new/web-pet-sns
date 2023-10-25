<select name="type" id="type">
    <option value="" selected>動物の種類を選択</option>
    <option value="dog">犬</option>
    <option value="cat">猫</option>
    <option value="fish">魚</option>
    <option value="bird">鳥</option>
    <option value="rabbit">ウサギ</option>
    <option value="hamster">ハムスター</option>
    <option value="guinea_pig">モルモット</option>
</select>
<select name="breed" id="breed"></select>

<script>
    let typeDropdown = document.getElementById('type');
    let breedDropdown = document.getElementById('breed');

    typeDropdown.addEventListener('change', function () {
        let selectedType = typeDropdown.value;

        while (breedDropdown.options.length > 0) {
            breedDropdown.remove(0);
        }

        if (selectedType === 'dog') {
            generateDogBreeds();
        } else if (selectedType === 'cat') {
            generateCatBreeds();
        } else if (selectedType === 'fish') {
            generateFishBreeds();
        } else if (selectedType === 'bird') {
            generateBirdBreeds();
        } else if (selectedType === 'rabbit') {
            generateRabbitBreeds();
        } else if (selectedType === 'hamster') {
            generateHamsterBreeds();
        } else if (selectedType === 'guinea_pig') {
            generateGuineaPigBreeds();
        }
        // 他の動物タイプと種類のオプションを追加
    });
    function generateDogBreeds() {
        breedDropdown.add(new Option('犬種を選択', ''));
        breedDropdown.add(new Option('ゴールデン・レトリバー', 'golden_retriever'));
        breedDropdown.add(new Option('ラブラドール・レトリバー', 'labrador_retriever'));
        breedDropdown.add(new Option('ポメラニアン', 'pomeranian'));
        breedDropdown.add(new Option('ダックスフンド', 'dachshund'));
        breedDropdown.add(new Option('ビーグル', 'beagle'));
        breedDropdown.add(new Option('ボクサー', 'boxer'));
        breedDropdown.add(new Option('シベリアン・ハスキー', 'siberian_husky'));
        breedDropdown.add(new Option('フレンチ・ブルドッグ', 'french_bulldog'));
        breedDropdown.add(new Option('チワワ', 'chihuahua'));
        breedDropdown.add(new Option('コッカースパニエル', 'cocker_spaniel'));
        breedDropdown.add(new Option('シェットランド・シープドッグ', 'shetland_sheepdog'));
        breedDropdown.add(new Option('ドーベルマン', 'doberman'));
        breedDropdown.add(new Option('ボルゾイ', 'borzoi'));
        breedDropdown.add(new Option('バセットハウンド', 'basset_hound'));
        breedDropdown.add(new Option('ウィペット', 'whippet'));
        breedDropdown.add(new Option('アフガン・ハウンド', 'afghan_hound'));
    }

    function generateCatBreeds() {
        breedDropdown.add(new Option('猫種を選択', ''));
        breedDropdown.add(new Option('シャム猫', 'siamese_cat'));
        breedDropdown.add(new Option('ペルシャ猫', 'persian_cat'));
        breedDropdown.add(new Option('スコティッシュフォールド', 'scottish_fold'));
        breedDropdown.add(new Option('マンチカン', 'munchkin'));
        breedDropdown.add(new Option('バーミーズ', 'burmese'));
        breedDropdown.add(new Option('シャルトリュー', 'chartreux'));
        breedDropdown.add(new Option('ヒマラヤン', 'himalayan'));
        breedDropdown.add(new Option('アビシニアン', 'abyssinian'));
        breedDropdown.add(new Option('エキゾチック・ショートヘア', 'exotic_short_hair'));
        breedDropdown.add(new Option('ロシアン・ブルー', 'russian_blue'));
        breedDropdown.add(new Option('ノルウェージャン・フォレストキャット', 'norwegian_forest_cat'));
        breedDropdown.add(new Option('トンキニーズ', 'tonkinese'));
        breedDropdown.add(new Option('エジプシャン・マウ', 'egyptian_mau'));
        breedDropdown.add(new Option('マンクス', 'manx'));
    }

    function generateFishBreeds() {
        breedDropdown.add(new Option('魚の種類を選択', ''));
        breedDropdown.add(new Option('ゴールデンフィッシュ', 'goldfish'));
        breedDropdown.add(new Option('ベタ', 'betta'));
        breedDropdown.add(new Option('クラウンテール', 'crown_tail'));
        breedDropdown.add(new Option('ガッピー', 'guppy'));
        breedDropdown.add(new Option('テトラ', 'tetra'));
    }

    function generateBirdBreeds() {
        breedDropdown.add(new Option('鳥の種類を選択', ''));
        breedDropdown.add(new Option('カナリア', 'canary'));
        breedDropdown.add(new Option('パロット', 'parrot'));
        breedDropdown.add(new Option('フィンチ', 'finch'));
        breedDropdown.add(new Option('コンゴウインコ', 'african_grey'));
        breedDropdown.add(new Option('コカトゥー', 'cockatoo'));
    }

    function generateRabbitBreeds() {
        breedDropdown.add(new Option('うさぎの種類を選択', ''));
        breedDropdown.add(new Option('ホーランド・ロップ', 'holland_lop'));
        breedDropdown.add(new Option('アメリカン・ファジーアーロップ', 'american_fuzzy_lop'));
        breedDropdown.add(new Option('ニュージーランドホワイト', 'new_zealand_white'));
        breedDropdown.add(new Option('ミニレックス', 'mini_rex'));
        breedDropdown.add(new Option('フレミッシュジャイアント', 'flemish_giant'));
    }

    function generateHamsterBreeds() {
        breedDropdown.add(new Option('ハムスターの種類を選択', ''));
        breedDropdown.add(new Option('シリアンハムスター', 'syrian_hamster'));
        breedDropdown.add(new Option('ロボロフスキーハムスター', 'roborovski_hamster'));
        breedDropdown.add(new Option('ジャングルキャットハムスター', 'jungle_cat_hamster'));
        breedDropdown.add(new Option('ロボアプシャラトフハムスター', 'roborovski_hamster'));
    }

    function generateGuineaPigBreeds() {
        breedDropdown.add(new Option('モルモットの種類を選択', ''));
        breedDropdown.add(new Option('アビシニアンモルモット', 'abyssinian_guinea_pig'));
        breedDropdown.add(new Option('ペルビアンモルモット', 'peruvian_guinea_pig'));
        breedDropdown.add(new Option('テディモルモット', 'teddy_guinea_pig'));
        breedDropdown.add(new Option('スキニーピッグ', 'skinny_pig'));
    }
</script>
