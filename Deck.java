import java.util.Random;
public class Deck {
    private Card[] deck;
    private static Random random = new Random();
    private static final int numSuits = 4;
    private static final int numRanks = 13;

    public Deck() {
        deck = new Card[numSuits * numRanks];
        for (int i = 1; i <= numRanks; i++) {
            for (int j = 0; j < numSuits; j++) {
                deck[i + j * numRanks -1] = new Card(i, j);
            }
        }
    }
    public Deck(int n) {
        this.deck = new Card[n];
    }
    public Card[] getDeck() {
        return this.deck;
    }
    public void display() {
        for (int i = 0; i < this.deck.length; i++) {
            System.out.println(deck[i]);
        }
    }
    public String toString() {
        StringBuilder text = new StringBuilder();
        for (int i = 0; i < this.deck.length; i++) {
            text.append(deck[i]);
            if (i < this.deck.length -1) {
                text.append("\n");
            }
        }
        return text.toString();
    }
    public int[] suitHist() {
        int[] hist = new int[numSuits];
        for (int i = this.deck.length -1; i >= 0; i--) {
            hist[deck[i].getSuit()]++;
        }
        return hist;
    }
    public boolean hasFlush() {
        boolean has = false;
        int[] hist = this.suitHist();
        for (int i = hist.length -1; i >= 0; i--) {
            if (hist[i] >= 5) {
                has = true;
                break;
            }
        }
        return has;
    }
    public int[] royalSuitHist() {
        int[] hist = new int[numSuits];
        for (int i = this.deck.length -1; i >= 0; i--) {
            if (deck[i].getRank() >= 10 || deck[i].getRank() == 1) hist[deck[i].getSuit()]++;
        }
        return hist;
    }
    public boolean hasRoyalFlush() {
        boolean has = false;
        int[] hist = this.royalSuitHist();
        for (int i = hist.length -1; i >= 0; i--) {
            if (hist[i] >= 5) {
                has = true;
                break;
            }
        }
        return has;
    }
    private static int randomInt(int low, int high) {
        return random.nextInt(low, high +1);
    }
    private void swapCards(int i, int j) {
        Card card;
        card = this.deck[i];
        this.deck[i] = this.deck[j];
        this.deck[j] = card;
    }
    public void shuffle() {
        int a;
        for (int i = this.deck.length-1; i > 0; i--) {
            a = randomInt(0, i);
            swapCards(i, a);
        }
    }
    private int indexLowest(int low, int high) {
        int indexLowest = low;
        for (int i = low; i <= high; i++) {
            if (deck[i].compareTo(deck[indexLowest]) == -1) indexLowest = i;
        }
        return indexLowest;
    }
    public void selectionSort() {
        for (int i = 0; i < this.deck.length; i++) {
            swapCards(i, indexLowest(i, this.deck.length -1));
        }
    }
    public Deck subdeck(int low, int high) {
        Deck sub = new Deck(high - low + 1);
        for (int i = 0; i < sub.deck.length; i++) {
            sub.deck[i] = this.deck[low + i];
        }
        return sub;
    }
    private static Deck merge(Deck d1, Deck d2) {
        Deck d3 = new Deck(d1.getDeck().length + d2.getDeck().length);

        // use the index i to keep track of where we are at in
        // the first deck, and the index j for the second deck
        int i = 0;
        int j = 0;

        // the index k traverses the result deck
        for (int k = 0; k < d3.getDeck().length; k++) {
            if (k > d3.getDeck().length -1) {
                break;
            } else if (i > d1.getDeck().length -1) {
                d3.deck[k] = new Card(d2.deck[j].getRank(), d2.deck[j].getSuit());
                j++;
                // if d1 is empty, use top card from d2
            } else if (j > d2.getDeck().length -1) {
                d3.deck[k] = new Card(d1.deck[i].getRank(), d1.deck[i].getSuit());
                i++;
                // if d2 is empty, use top card from d1
            } else {
                if (d1.deck[i].compareTo(d2.deck[j]) == -1) {
                    d3.deck[k] = new Card(d1.deck[i].getRank(), d1.deck[i].getSuit());
                    i++;
                } else if (d1.deck[i].compareTo(d2.deck[j]) == 1) {
                    d3.deck[k] = new Card(d2.deck[j].getRank(), d2.deck[j].getSuit());
                    j++;
                } else {
                    d3.deck[k] = new Card(d1.deck[i].getRank(), d1.deck[i].getSuit());
                    i++;
                    k++;
                    d3.deck[k] = new Card(d2.deck[j].getRank(), d2.deck[j].getSuit());
                    j++;
                }
                // otherwise, compare the top two cards
                // add lowest card to the new deck at k
                // increment i or j (depending on card)
            } 
        }
        return d3;
        // return the new deck
    }
    public Deck almostMergeSort() {
        int mid = this.deck.length /2;
        Deck d1 = this.subdeck(0, mid-1);
        Deck d2 = this.subdeck(mid, this.deck.length-1);
        d1.selectionSort();
        d2.selectionSort();
        return Deck.merge(d1, d2);
        // divide the deck into two subdecks
        // sort the subdecks using selectionSort
        // merge the subdecks, return the result
    }
    public Deck mergeSort() {
        // if the deck has 0 or 1 cards, return it
        // otherwise, divide the deck into two subdecks
        int mid = this.deck.length /2;
        Deck d1 = this.subdeck(0, mid-1);
        Deck d2 = this.subdeck(mid, this.deck.length-1);
        Deck d3;
        if (this.deck.length > 1) {
            // sort the subdecks using mergeSort
            d1 = d1.mergeSort();
            d2 = d2.mergeSort();
            // merge the subdecks
            d3 = Deck.merge(d1, d2);
            // return the result
            
        } else {
            d3 = this;
        }
        return d3; 
    }
    
    /*public static void main(String[] args) {
        Deck d0 = new Deck();
        d0.shuffle();
        d0 = d0.mergeSort();
        d0.display();
    }*/
    public static void main(String[] args) {
        Deck d0 = new Deck();
        d0.shuffle();
        System.out.println(d0);
    }
}