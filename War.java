/**
 * Simulates a simple card game.
 */
public class War {

    public static void main(String[] args) {

        // create and shuffle the deck
        Deck deck = new Deck();
        deck.shuffle();

        // divide the deck into piles
        Pile p1 = new Pile();
        p1.addDeck(deck.subdeck(0, 25));
        Pile p2 = new Pile();
        p2.addDeck(deck.subdeck(26, 51));

        // while both piles are not empty
        while (!p1.isEmpty() && !p2.isEmpty()) {
            Card c1 = p1.popCard();
            Card c2 = p2.popCard();
            Pile tiePile1 = new Pile();
            Pile tiePile2 = new Pile();

            // compare the cards
            int diff = c1.getRank() - c2.getRank();
            if (diff > 0) {
                p1.addCard(c1);
                p1.addCard(c2);
            } else if (diff < 0) {
                p2.addCard(c1);
                p2.addCard(c2);
            } else {
                //Todo esto debe ser recursivo.
                for (int i = 4; i > 0; i--) {
                    if (p1.getCards().size() >= i && p2.getCards().size() >= i) {
                        //Cuando empatan las cartas, si ambos jugadores tienen más de 4 cartas:
                        //Se sacan 4 cartas de cada y se compara la 4ª, el que gana se las lleva todas
                        for (int j = 0; j < i; j++) {
                            tiePile1.addCard(p1.popCard());
                            tiePile2.addCard(p2.popCard());
                        }
                        if (tiePile1.getCards().get(tiePile1.getCards().size() -1).getRank() > tiePile2.getCards().get(tiePile2.getCards().size() -1).getRank()) {
                            p1.addCards(tiePile2.getCards());
                            p1.addCards(tiePile1.getCards());
                            for (int k = 0; k <= tiePile1.getCards().size(); k++) {
                                tiePile1.popCard();
                                tiePile2.popCard();
                            }
                            break;
                        } else if (tiePile1.getCards().get(tiePile1.getCards().size() -1).getRank() < tiePile2.getCards().get(tiePile2.getCards().size() -1).getRank()) {
                            p2.addCards(tiePile1.getCards());
                            p2.addCards(tiePile2.getCards());
                            for (int k = 0; k <= tiePile1.getCards().size(); k++) {
                                tiePile1.popCard();
                                tiePile2.popCard();
                            }
                            break;
                        }
                        //Si empatan otra vez, se repite desde el paso anterior, pero con un número menos. 3, 2, 1.
                        
                    } else if (p1.getCards().size() < i && p2.getCards().size() < i) {
                        System.out.println("None of the players have any cards left, it's a tie.");
                        return;
                    } else if (p1.getCards().size() < i) {
                        System.out.println("Player 1 doesn't have enough cards, so player 2 wins.");
                        return;
                    } else {
                        System.out.println("Player 2 doesn't have enough cards, so player 1 wins.");
                        return;
                    }
                    // it's a tie...draw four more cards
                }
            }
        }

        // display the winner
        if (p2.isEmpty()) {
            System.out.println("Player 1 wins!");
        } else {
            System.out.println("Player 2 wins!");
        }
    }

}
