import java.util.ArrayList;

public class Pile {
    private ArrayList<Card> cards;

    public Pile() {
        this.cards = new ArrayList<Card>();
    }
    public Card popCard() {
        return this.cards.remove(0);  // from the top of the pile
    }
    public void addCard(Card card) {
        this.cards.add(card);        // to the bottom of the pile
    }
    public boolean isEmpty() {
        return this.cards.isEmpty();
    }
    public void addDeck(Deck deck) {
        for (Card card : deck.getDeck()) {
            this.cards.add(card);
        }
    }
    public void insertionSort() {
        
        for (int i = 1; i < this.cards.size(); i++) {
            for (int j = 0; j < i; j++) {
                if (this.cards.get(i).compareTo(this.cards.get(j)) == -1) {
                    this.cards.add(j, this.cards.get(i));
                    this.cards.remove(i+1);
                }
            }
        }
    }
    public void display() {
        for (int i = 0; i < this.cards.size(); i++) {
            System.out.println(this.cards.get(i));
        }
    }
    public ArrayList<Card> getCards() {
        return this.cards;
    }
    public void addCards(ArrayList<Card> cards2) {
        this.cards.addAll(cards2);
    }
    public void eraseAll() {
        this.cards.clear();
    }
    public static void main(String[] args) {
        Pile mazo = new Pile();
        Deck d0 = new Deck(4);
        mazo.addDeck(d0);
        System.out.println(mazo.cards.size());
    }
    /*public static void main(String[] args) {
        Deck deck = new Deck();
        deck.shuffle();
        Pile p1 = new Pile();
        p1.addDeck(deck.subdeck(0, 25));

        Pile p2 = new Pile();
        p2.addDeck(deck.subdeck(26, 51));
        while (!p1.isEmpty() && !p2.isEmpty()) {
            // pop a card from each pile
            Card c1 = p1.popCard();
            Card c2 = p2.popCard();
        
            // compare the cards
            int diff = c1.getRank() - c2.getRank();
            if (diff > 0) {
                p1.addCard(c1);
                p1.addCard(c2);
            } else if (diff < 0) {
                p2.addCard(c1);
                p2.addCard(c2);
            } else {

                // it's a tie
            }
        }
        if (p2.isEmpty()) {
            System.out.println("Player 1 wins!");
        } else {
            System.out.println("Player 2 wins!");
        }
    }*/
}