from pip._vendor import requests
import pandas as pd
import numpy as np
import operator
from sklearn.metrics.pairwise import cosine_similarity
import sys
import ast

def main():

    response = requests.get('http://musify.com/api/similarity')
    s = str(response.content)
    start = "b'"
    end = "<link"

    json_data = s[s.find(start)+len(start):s.rfind(end)]

    real_data = ast.literal_eval(json_data)
    numpy_data = np.array(real_data)

    index_values = list(range(0, numpy_data.shape[0]))

    Ratings = pd.DataFrame(data=numpy_data, index=index_values, columns=["userID", "genreID", "rating"])

    Mean = Ratings.groupby(by="userID", as_index=False)['rating'].mean()
    Rating_avg = pd.merge(Ratings, Mean, on='userID')
    Rating_avg['adg_rating'] = Rating_avg['rating_x'] - Rating_avg['rating_y']

    final = pd.pivot_table(Rating_avg, values='adg_rating', index='userID', columns='genreID')

    final_user = final.apply(lambda row: row.fillna(row.mean()), axis=1)

    b = cosine_similarity(final_user)
    np.fill_diagonal(b, 0)
    similarity_with_user = pd.DataFrame(b, index=final_user.index)
    similarity_with_user.columns = final_user.index
    similarity_with_user = similarity_with_user.round(5)

    user_id = sys.argv[1].strip("''")

    UserSimilarity(similarity_with_user, int(user_id))


def UserSimilarity(table, user1):
    userDict = {}
    for i in range(1, table.shape[0] + 1):
        if i != user1:
            userDict[i] = table.loc[user1, i]
    sorted_d = dict(sorted(userDict.items(), key=operator.itemgetter(1), reverse=True))

    similiarUsers = ""
    for key in sorted_d:
        similiarUsers += str(key) + ", "

    # print("Uporabniki, ki imajo podoben okus uporabniku " + str(user1) + " so po vrstnem redu: " + similiarUsers[:-2])
    print(similiarUsers[:-2])

if __name__ == "__main__":
    main()
