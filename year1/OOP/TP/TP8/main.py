import re

exemple = """
P1 est un produit composé de P2 et P3
P2 est un produit élémentaire
P5 est un produit composé de P1 et P2
P4 est un produit élémentaire
P9 est un produit composé de P1, P6 et P4
P10 est un produit composé de P3 et P5
P11 est un produit composé de P5 et P3 """

# Q1
# produit_elementaires = re.findall(r"(P[0-9]+) est un produit élémentaire", exemple)
# print(produit_elementaires)

# match = re.search(r"(P[0-9]+) est un produit élémentaire", exemple)
# if match:
#     print(match.group())  # Prints the entire matched string
#     print(match.group(1))

# Q2
# produit_compose = re.findall(r"(P[0-9]+) est un produit composé de P[0-9]+, P[0-9]+ et P[0-9]+", exemple)
# print(produit_compose)

# Q3
# produit_compose = re.findall(r"(P[0-9]+) est un produit composé de (?:P3 et P5|P5 et P3)", exemple)
# print(produit_compose)

# Q4

# produit_compose = re.findall(r"(P\d+) est un produit composé de (?!.*P2)", exemple)
# print(produit_compose)

# Q5
matches = re.search(r"P9 est un produit composé de (.+)", exemple)#.group(1)
p9_composants = re.findall(r"(P[0-9]+)", matches.group(1))
print(p9_composants)


